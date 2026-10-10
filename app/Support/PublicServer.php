<?php

namespace App\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * The public server's live status, for its page. Read from
 * config('stvr.public_server.status_url'), a JSON document in the shape of
 * docs/public-server-status.md, and cached for a few seconds as the raw array
 * (never as objects: see CLAUDE.md, "Do not cache objects").
 *
 * Everything that comes in is checked and trimmed here, so the view only ever
 * sees plain values of the right type. A feed that cannot be read, or that has
 * not been updated for STALE_SECONDS, makes the server show as offline rather
 * than as online with old numbers.
 */
final class PublicServer
{
    private const CACHE_KEY = 'stvr.public_server.status';

    private const STALE_SECONDS = 180;

    private const MAX_PLAYERS_SHOWN = 64;

    /**
     * @return array{configured: bool, live: bool, online: bool, name: ?string, address: ?string, version: ?string,
     *               protocol: ?string, password: bool, max: ?int, count: int, hidden: int, players: list<array>,
     *               startedAt: ?string, updatedAt: ?string, sample: bool}
     */
    public function status(): array
    {
        $url = trim((string) config('stvr.public_server.status_url'));
        $raw = $url === '' ? null : Cache::remember(
            self::CACHE_KEY,
            now()->addSeconds(max(5, (int) config('stvr.public_server.cache_seconds', 30))),
            fn () => $this->fetch($url) ?? false,
        );

        return $this->normalise(is_array($raw) ? $raw : null, $url !== '', $url === 'sample');
    }

    private function fetch(string $url): ?array
    {
        if ($url === 'sample') {
            if (app()->isProduction()) {
                return null;
            }
            $sample = (array) json_decode((string) file_get_contents(resource_path('fixtures/public-server.sample.json')), true);
            // The sample is always fresh, so the page can be reviewed at any time.
            $sample['updated_at'] = now()->toIso8601String();

            return $sample;
        }

        try {
            $response = Http::timeout(4)->acceptJson()->get($url);

            return $response->successful() && is_array($response->json()) ? $response->json() : null;
        } catch (\Throwable $e) {
            Log::info('stvr: public server status unreadable', ['error' => $e->getMessage()]);

            return null;
        }
    }

    private function normalise(?array $raw, bool $configured, bool $sample): array
    {
        $str = fn ($v, int $max = 80) => is_string($v) && trim($v) !== '' ? mb_substr(trim($v), 0, $max) : null;
        $updated = $this->time($raw['updated_at'] ?? null);
        $fresh = $updated !== null && $updated->diffInSeconds(now(), true) <= self::STALE_SECONDS;
        $online = $raw !== null && $fresh && ($raw['online'] ?? false) === true;

        $players = [];
        if ($online) {
            foreach (array_slice((array) ($raw['players'] ?? []), 0, self::MAX_PLAYERS_SHOWN) as $i => $p) {
                if (! is_array($p) || ($name = $str($p['name'] ?? null, 40)) === null) {
                    continue;
                }
                $point = $this->point($p);
                $heading = $p['heading'] ?? null;
                $players[] = [
                    // A random token per connection, never anything about the person: the key that lets the page move
                    // a dot rather than redraw it. Kept to plain characters, since it ends up in an HTML attribute.
                    'id'      => is_string($p['id'] ?? null) ? substr(preg_replace('/[^A-Za-z0-9_-]/', '', $p['id']), 0, 16) : 'p'.$i,
                    'name'    => $name,
                    // In the player's own game language: a French player's "Rivebois" on the English page.
                    'where'   => $str($p['location'] ?? null, 60),
                    'point'   => $point,
                    'heading' => $point && is_numeric($heading) ? ((int) round($heading) % 360 + 360) % 360 : null,
                ];
            }
        }

        $max = $raw['max_players'] ?? null;
        // player_count includes players who chose not to be listed; the list is only those who did not.
        $count = $raw['player_count'] ?? null;
        $count = $online ? (is_int($count) && $count >= count($players) ? $count : count($players)) : 0;

        return [
            'configured' => $configured,
            'live'       => $raw !== null,
            'online'     => $online,
            'name'       => $str($raw['name'] ?? null),
            'address'    => $str($raw['address'] ?? null, 100),
            'version'    => $str($raw['version'] ?? null, 20),
            'protocol'   => $str($raw['protocol'] ?? null, 40),
            'password'   => ($raw['password'] ?? false) === true,
            'max'        => is_int($max) && $max > 0 ? $max : null,
            'count'      => $count,
            'hidden'     => max(0, $count - count($players)),
            'players'    => $players,
            'startedAt'  => $online ? $this->time($raw['started_at'] ?? null)?->toIso8601String() : null,
            'updatedAt'  => $updated?->toIso8601String(),
            'sample'     => $sample,
        ];
    }

    /**
     * Where a player stands on our map, or null: inside a building, in another worldspace, or without a position.
     * Two calibration points (config stvr.public_server.map) fix the scale and offset on each axis; the in-game Y
     * grows northwards, the drawing's Y grows downwards, and the calibration carries that sign.
     */
    private function point(array $p): ?array
    {
        $x = $p['x'] ?? null;
        $y = $p['y'] ?? null;

        if (($p['worldspace'] ?? null) !== 'Tamriel' || ! is_numeric($x) || ! is_numeric($y)) {
            return null;
        }

        $a = config('stvr.public_server.map.a');
        $b = config('stvr.public_server.map.b');
        $dx = $b['world'][0] - $a['world'][0];
        $dy = $b['world'][1] - $a['world'][1];

        if ($dx == 0 || $dy == 0) {
            return null;
        }

        $sx = $a['svg'][0] + ($x - $a['world'][0]) * ($b['svg'][0] - $a['svg'][0]) / $dx;
        $sy = $a['svg'][1] + ($y - $a['world'][1]) * ($b['svg'][1] - $a['svg'][1]) / $dy;

        // Off the drawing is no use to anyone: drop it rather than pin it to an edge.
        return $sx >= 0 && $sx <= 1000 && $sy >= 0 && $sy <= 640 ? [round($sx, 1), round($sy, 1)] : null;
    }

    private function time(mixed $value): ?Carbon
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (\Throwable) {
            return null;
        }
    }
}
