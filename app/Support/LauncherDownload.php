<?php

namespace App\Support;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * The launcher, as players get it from this site (Emma, 2026-10-07: a click
 * downloads it, nobody sees GitHub). GitHub builds it at every push to the
 * launcher's repository and releases it there when its version goes up (that
 * repository's .github/workflows/release.yml); the repository may stay
 * private, read with a token.
 *
 * The newest release is asked for at most every `cache_minutes`. Its setup.exe
 * and signature are copied into storage once, and the site serves that copy,
 * both to the download button and to installed launchers asking for an update
 * (latest.json). GitHub unreachable, no token, or nothing released: the copy
 * already here is served; with none, the button says "Not released yet".
 */
final class LauncherDownload
{
    private const CACHE_KEY = 'stvr.launcher.release';

    private const FOLDER = 'launcher';

    public function current(): ?LauncherBuild
    {
        Cache::remember(
            self::CACHE_KEY,
            now()->addMinutes(max(1, (int) config('stvr.github.cache_minutes', 30))),
            fn () => $this->sync() ?? false,
        );

        return $this->newestStored();
    }

    /** For the download card: the file under this site's address. */
    public function asset(): ?ReleaseAsset
    {
        $build = $this->current();

        return $build === null ? null : new ReleaseAsset(
            name: $build->name,
            url: route('launcher.file', ['name' => $build->name]),
            size: $build->size,
            kind: 'launcher',
        );
    }

    /** A stored launcher by its exact name, for the download route; null for anything else. */
    public function stored(string $name): ?string
    {
        $path = self::FOLDER.'/'.$name;

        return $name === basename($name) && $this->isLauncher($name) && Storage::disk('local')->exists($path)
            ? $path
            : null;
    }

    private function isLauncher(string $name): bool
    {
        return str_ends_with(strtolower($name), '-setup.exe');
    }

    /** Copies the newest release in when it is not here yet; returns its file name, null when nothing came. */
    private function sync(): ?string
    {
        $repo = trim((string) config('stvr.launcher.repo'));

        if ($repo === '') {
            return null;
        }

        $headers = ['Accept' => 'application/vnd.github+json', 'X-GitHub-Api-Version' => '2022-11-28'];

        if ($token = config('stvr.launcher.token')) {
            $headers['Authorization'] = 'Bearer '.$token;
        }

        try {
            $response = Http::withHeaders($headers)
                ->timeout((int) config('stvr.github.timeout', 6))
                ->get("https://api.github.com/repos/{$repo}/releases/latest");

            if (! $response->successful()) {
                return null;
            }

            $release = (array) $response->json();
            $assets = collect($release['assets'] ?? []);
            $exe = $assets->first(fn ($a) => $this->isLauncher((string) ($a['name'] ?? '')));
            $sig = $exe ? $assets->firstWhere('name', $exe['name'].'.sig') : null;

            if (! $exe || ! $sig) {
                return null;
            }

            $name = basename((string) $exe['name']);
            $disk = Storage::disk('local');

            if (! $disk->exists(self::FOLDER."/{$name}")) {
                $signature = $this->fetch($repo, (int) $sig['id'], $headers, 20);
                $file = $this->fetch($repo, (int) $exe['id'], $headers, 180);

                if ($signature === null || $file === null || trim($signature->body()) === '') {
                    return null;
                }

                $disk->put(self::FOLDER."/{$name}.sig", trim($signature->body()));
                $disk->put(self::FOLDER."/{$name}.json", (string) json_encode([
                    'notes'        => $release['body'] ?? null,
                    'published_at' => $release['published_at'] ?? null,
                ]));
                // The exe last, through a temporary name: a half copy is never offered.
                $disk->put(self::FOLDER."/{$name}.part", $file->body());
                $disk->move(self::FOLDER."/{$name}.part", self::FOLDER."/{$name}");
            }

            $this->prune($name);

            return $name;
        } catch (\Throwable $e) {
            Log::info('stvr: launcher release lookup failed', ['error' => $e->getMessage()]);

            return null;
        }
    }

    /**
     * One file of a release. GitHub's API answers an asset's address with the file itself when asked for
     * application/octet-stream (through a redirect to its storage), which works for a private repository too.
     */
    private function fetch(string $repo, int $id, array $headers, int $timeout): ?Response
    {
        $response = Http::withHeaders(array_merge($headers, ['Accept' => 'application/octet-stream']))
            ->timeout($timeout)
            ->get("https://api.github.com/repos/{$repo}/releases/assets/{$id}");

        return $response->successful() ? $response : null;
    }

    /** Only the newest copy is kept. */
    private function prune(string $keep): void
    {
        $disk = Storage::disk('local');

        foreach ($disk->files(self::FOLDER) as $path) {
            if (! str_starts_with(basename($path), $keep)) {
                $disk->delete($path);
            }
        }
    }

    private function newestStored(): ?LauncherBuild
    {
        $disk = Storage::disk('local');
        $names = array_values(array_filter(
            array_map('basename', $disk->files(self::FOLDER)),
            fn (string $name) => $this->isLauncher($name) && $disk->exists(self::FOLDER."/{$name}.sig"),
        ));

        if ($names === []) {
            return null;
        }

        usort($names, fn (string $a, string $b) => strnatcasecmp($b, $a));
        $name = $names[0];
        $meta = (array) json_decode((string) $disk->get(self::FOLDER."/{$name}.json"), true);

        return new LauncherBuild(
            name: $name,
            version: preg_match('/_(\d+\.\d+\.\d+)_/', $name, $m) ? $m[1] : null,
            size: (int) $disk->size(self::FOLDER."/{$name}"),
            signature: trim((string) $disk->get(self::FOLDER."/{$name}.sig")),
            notes: $meta['notes'] ?? null,
            publishedAt: $meta['published_at'] ?? null,
        );
    }
}
