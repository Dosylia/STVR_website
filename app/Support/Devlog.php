<?php

namespace App\Support;

/**
 * The devlog is flat markdown files, not a database.
 *
 * Reasons: entries are written by hand in an editor, they are part of the repo
 * so they are reviewed and reverted like code, and the site keeps working with
 * no database at all. The canonical list of entries is the English folder —
 * a post always exists in English first, and a missing translation falls back
 * to English with a visible note rather than vanishing from the other languages.
 */
final class Devlog
{
    /**
     * Parsed entries, for this request only.
     *
     * Deliberately *not* a persistent cache. Laravel's file store restricts
     * unserialize() to an allow-list of classes, so a cached DevlogEntry comes
     * back as __PHP_Incomplete_Class and every page that touches the devlog
     * 500s — in production only, because that is the only place the cache was
     * enabled. Caching a handful of small markdown files to save a few
     * microseconds was never worth a failure mode that cannot show up locally.
     *
     * @var array<string, array<int, DevlogEntry>>
     */
    private array $memo = [];

    /** @return array<int, DevlogEntry>  newest first */
    public function all(string $locale): array
    {
        return $this->memo[$locale] ??= $this->load($locale);
    }

    public function find(string $locale, string $slug): ?DevlogEntry
    {
        foreach ($this->all($locale) as $entry) {
            if ($entry->slug === $slug) {
                return $entry;
            }
        }

        return null;
    }

    /** @return array<int, DevlogEntry> */
    public function latest(string $locale, int $limit = 3): array
    {
        return array_slice($this->all($locale), 0, $limit);
    }

    /** @return array<int, DevlogEntry> */
    private function load(string $locale): array
    {
        $fallback = (string) config('stvr.fallback_locale', 'en');
        $canonical = $this->directory($fallback);

        if (! is_dir($canonical)) {
            return [];
        }

        $entries = [];

        foreach (glob($canonical.'/*.md') ?: [] as $path) {
            $slug = basename($path, '.md');
            $localised = $this->directory($locale).'/'.$slug.'.md';
            $translated = $locale === $fallback || is_file($localised);
            $source = $translated && is_file($localised) ? $localised : $path;

            $entry = $this->parse($slug, (string) file_get_contents($source), $translated);

            if ($entry !== null) {
                $entries[] = $entry;
            }
        }

        usort($entries, fn (DevlogEntry $a, DevlogEntry $b) => $b->date <=> $a->date);

        return $entries;
    }

    private function directory(string $locale): string
    {
        return resource_path('devlog/'.$locale);
    }

    /**
     * Front matter is a handful of `key: value` lines between two `---` fences.
     * Deliberately not YAML: three keys do not justify a parser, and a typo in a
     * real YAML document fails in ways that are hard to see in a diff.
     */
    private function parse(string $slug, string $raw, bool $translated): ?DevlogEntry
    {
        $raw = ltrim(str_replace("\r\n", "\n", $raw));

        if (! str_starts_with($raw, '---')) {
            return null;
        }

        $parts = preg_split('/^---\s*$/m', $raw, 3);

        if ($parts === false || count($parts) < 3) {
            return null;
        }

        $meta = [];

        foreach (preg_split('/\n/', trim($parts[1])) ?: [] as $line) {
            if (! str_contains($line, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $line, 2);
            $meta[strtolower(trim($key))] = trim($value);
        }

        if (blank($meta['title'] ?? null) || blank($meta['date'] ?? null)) {
            return null;
        }

        try {
            $date = new \DateTimeImmutable($meta['date']);
        } catch (\Throwable) {
            return null;
        }

        $tags = array_values(array_filter(array_map(
            'trim',
            explode(',', $meta['tags'] ?? '')
        )));

        return new DevlogEntry(
            slug: $slug,
            title: $meta['title'],
            date: $date,
            summary: $meta['summary'] ?? '',
            tags: $tags,
            markdown: trim($parts[2]),
            translated: $translated,
        );
    }
}
