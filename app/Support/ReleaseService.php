<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Reads the newest published release off the GitHub API.
 *
 * Three things matter here and none of them is the happy path:
 *
 *  1. The repository may have no releases at all (it does not, today). GitHub
 *     answers 404 for /releases/latest in that case, which is not an error.
 *  2. GitHub may be slow, rate-limited or down. A promo page must not hang or
 *     500 because of that.
 *  3. Whatever happens, the page still needs a working download button.
 *
 * So: short timeout, cached result, and a configured fallback underneath. The
 * negative result is cached too, as `false`, because Cache::remember treats a
 * cached null as a miss. Otherwise every visit while GitHub is sulking costs
 * six seconds.
 */
final class ReleaseService
{
    private const CACHE_KEY = 'stvr.release.latest';

    public function latest(): Release
    {
        $minutes = max(1, (int) config('stvr.github.cache_minutes', 30));

        // `false`, not `null`, for "there is nothing to show". Cache::remember
        // treats a null as a miss and re-runs the closure, so a null here would
        // mean every single visit while GitHub is unreachable pays the full
        // timeout, which is the one case the cache exists for.
        $payload = Cache::remember(
            self::CACHE_KEY,
            now()->addMinutes($minutes),
            fn () => $this->fetch() ?? false,
        );

        return $payload === false
            ? $this->fallback()
            : $this->hydrate($payload);
    }

    public function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /** @return array<string, mixed>|null  null means "use the fallback" */
    private function fetch(): ?array
    {
        $repo = trim((string) config('stvr.github.repo'));

        if ($repo === '') {
            return null;
        }

        $headers = ['Accept' => 'application/vnd.github+json', 'X-GitHub-Api-Version' => '2022-11-28'];

        if ($token = config('stvr.github.token')) {
            $headers['Authorization'] = 'Bearer '.$token;
        }

        try {
            $response = Http::withHeaders($headers)
                ->timeout((int) config('stvr.github.timeout', 6))
                ->get("https://api.github.com/repos/{$repo}/releases/latest");
        } catch (\Throwable $e) {
            Log::info('stvr: GitHub release lookup failed', ['error' => $e->getMessage()]);

            return null;
        }

        // 404 is the normal answer for a repo that has not tagged a release yet.
        if (! $response->successful()) {
            return null;
        }

        $json = $response->json();

        return is_array($json) ? $json : null;
    }

    /** @param  array<string, mixed>  $json */
    private function hydrate(array $json): Release
    {
        $assets = [];

        foreach ($json['assets'] ?? [] as $asset) {
            $name = (string) ($asset['name'] ?? '');

            if ($name === '') {
                continue;
            }

            $assets[] = new ReleaseAsset(
                name: $name,
                url: (string) ($asset['browser_download_url'] ?? ''),
                size: (int) ($asset['size'] ?? 0),
                kind: $this->classify($name),
                downloads: (int) ($asset['download_count'] ?? 0),
            );
        }

        return new Release(
            tag: $json['tag_name'] ?? null,
            // `?:` alone is not enough: GitHub omits `name` entirely for an
            // untitled release, and reading a missing key is a fatal in a strict
            // error handler.
            name: ($json['name'] ?? null) ?: ($json['tag_name'] ?? null),
            publishedAt: $this->date($json['published_at'] ?? null),
            url: $json['html_url'] ?? null,
            notes: $json['body'] ?? null,
            assets: $assets,
            live: true,
        );
    }

    /**
     * Which of the two zips is this? First matching rule wins, so the narrow
     * "-update.zip" rule is listed before the catch-all ".zip".
     */
    private function classify(string $filename): string
    {
        $lower = strtolower($filename);

        foreach ((array) config('stvr.asset_kinds', []) as $kind => $needles) {
            foreach ((array) $needles as $needle) {
                if (str_contains($lower, strtolower($needle))) {
                    return $kind;
                }
            }
        }

        return 'other';
    }

    private function fallback(): Release
    {
        $fallback = (array) config('stvr.github.fallback', []);

        if (blank($fallback['tag'] ?? null) && blank($fallback['url'] ?? null)) {
            return Release::empty();
        }

        $assets = [];

        foreach (['full' => 'full_size', 'patch' => 'patch_size'] as $kind => $key) {
            if (filled($fallback[$key] ?? null)) {
                $assets[] = new ReleaseAsset(
                    name: $kind,
                    url: (string) ($fallback['url'] ?? ''),
                    size: 0,
                    kind: $kind,
                );
            }
        }

        return new Release(
            tag: $fallback['tag'] ?: null,
            name: $fallback['tag'] ?: null,
            publishedAt: $this->date($fallback['published_at'] ?? null),
            url: $fallback['url'] ?: null,
            notes: null,
            assets: $assets,
            live: false,
        );
    }

    private function date(?string $raw): ?\DateTimeImmutable
    {
        if (blank($raw)) {
            return null;
        }

        try {
            return new \DateTimeImmutable($raw);
        } catch (\Throwable) {
            return null;
        }
    }
}
