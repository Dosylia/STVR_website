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
     *               maps: array<string, int>, openMap: ?string, startedAt: ?string, updatedAt: ?string, sample: bool}
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
                [$map, $point] = $this->place($p);
                $heading = $p['heading'] ?? null;
                $area = is_string($p['worldspace'] ?? null) ? config('stvr.public_server.areas.'.$p['worldspace']) : null;
                $players[] = [
                    // A random token per connection, never anything about the person: the key that lets the page move
                    // a dot rather than redraw it. Kept to plain characters, since it ends up in an HTML attribute.
                    'id'      => is_string($p['id'] ?? null) ? substr(preg_replace('/[^A-Za-z0-9_-]/', '', $p['id']), 0, 16) : 'p'.$i,
                    'name'    => $name,
                    // In the player's own game language: a French player's "Rivebois" on the English page.
                    'where'   => $str($p['location'] ?? null, 60),
                    // Which drawing the dot is on ('skyrim', 'solstheim'), and the area's name for anyone outside main
                    // Skyrim: Solstheim, the Soul Cairn... (null in Skyrim, and indoors, where no worldspace comes).
                    'map'     => $map,
                    'area'    => $area !== 'skyrim' ? $area : null,
                    'point'   => $point,
                    'heading' => $point && is_numeric($heading) ? ((int) round($heading) % 360 + 360) % 360 : null,
                ];
            }
        }

        // How many are on each drawing, in the config's order, and the one the page opens on: the busiest, Skyrim when
        // it is a tie.
        $maps = [];
        foreach ((array) config('stvr.public_server.maps') as $map) {
            $maps[$map['slug']] = count(array_filter($players, fn ($p) => $p['map'] === $map['slug']));
        }
        $open = $maps ? array_search(max($maps), $maps, true) : null;

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
            'maps'       => $maps,
            'openMap'    => $open,
            'startedAt'  => $online ? $this->time($raw['started_at'] ?? null)?->toIso8601String() : null,
            'updatedAt'  => $updated?->toIso8601String(),
            'sample'     => $sample,
        ];
    }

    /**
     * Which drawing a player is on and where, as [slug, [x, y]], or [null, null]: indoors, in a worldspace without a
     * drawing, or without a position. Each worldspace's two calibration points (config stvr.public_server.maps) fix
     * the scale and offset on each axis; the in-game Y grows northwards, the drawing's Y grows downwards, and the
     * calibration carries that sign. A walled city is placed on the drawing of the worldspace it belongs to.
     */
    private function place(array $p): array
    {
        $x = $p['x'] ?? null;
        $y = $p['y'] ?? null;
        $worldspace = is_string($p['worldspace'] ?? null) ? $p['worldspace'] : null;
        $worldspace = config('stvr.public_server.shared.'.$worldspace) ?? $worldspace;
        $map = $worldspace !== null ? config('stvr.public_server.maps.'.$worldspace) : null;

        if (! is_array($map) || ! is_numeric($x) || ! is_numeric($y)) {
            return [null, null];
        }

        [$a, $b] = [$map['a'], $map['b']];
        $dx = $b['world'][0] - $a['world'][0];
        $dy = $b['world'][1] - $a['world'][1];

        if ($dx == 0 || $dy == 0) {
            return [null, null];
        }

        $sx = $a['svg'][0] + ($x - $a['world'][0]) * ($b['svg'][0] - $a['svg'][0]) / $dx;
        $sy = $a['svg'][1] + ($y - $a['world'][1]) * ($b['svg'][1] - $a['svg'][1]) / $dy;

        // Off the drawing is no use to anyone: drop it rather than pin it to an edge.
        return $sx >= 0 && $sx <= 1000 && $sy >= 0 && $sy <= 640
            ? [$map['slug'], [round($sx, 1), round($sy, 1)]]
            : [null, null];
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
