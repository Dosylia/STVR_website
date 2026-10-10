<?php

namespace App\Support;

/**
 * Builds every internal URL, in every language.
 *
 * Views never concatenate a path. They ask for a page id and get a URL for the
 * current language, which is what makes the language switcher able to hand a
 * visitor the *same page* in German rather than dumping them on the home page,
 * the single thing that most often goes wrong on a multilingual site.
 */
final class Nav
{
    /** Page ids in the order they appear in the main navigation. */
    public const MENU = ['download', 'install', 'host', 'roadmap', 'devlog', 'faq'];

    /** The menu as shown: the public server page joins it only once it is switched on. */
    public static function menu(): array
    {
        if (! config('stvr.public_server.enabled')) {
            return self::MENU;
        }

        $menu = self::MENU;
        array_splice($menu, array_search('host', $menu, true) + 1, 0, ['public']);

        return $menu;
    }

    public static function locales(): array
    {
        return array_keys((array) config('stvr.locales', []));
    }

    public static function supports(?string $locale): bool
    {
        return $locale !== null && in_array($locale, self::locales(), true);
    }

    public static function fallback(): string
    {
        return (string) config('stvr.fallback_locale', 'en');
    }

    /**
     * @param  string  $page   a key from config('stvr.paths')
     * @param  array<string, string>  $params  currently only ['slug' => ...] for a devlog entry
     */
    public static function url(string $page, ?string $locale = null, array $params = []): string
    {
        $locale = self::supports($locale) ? $locale : app()->getLocale();
        $locale = self::supports($locale) ? $locale : self::fallback();

        $segment = (string) (config("stvr.paths.{$page}.{$locale}") ?? $page);

        $path = '/'.$locale;

        if ($segment !== '') {
            $path .= '/'.$segment;
        }

        if (filled($params['slug'] ?? null)) {
            $path .= '/'.$params['slug'];
        }

        return url($path);
    }

    /**
     * The same page in every language, for the switcher and for hreflang.
     *
     * @return array<string, array{code: string, name: string, short: string, rune: string, url: string, current: bool}>
     */
    public static function alternates(string $page, array $params = []): array
    {
        $out = [];

        foreach ((array) config('stvr.locales', []) as $code => $meta) {
            $out[$code] = [
                'code'    => $code,
                'tag'     => $meta['tag'] ?? $code,
                'name'    => $meta['name'] ?? strtoupper($code),
                'short'   => $meta['short'] ?? strtoupper($code),
                'rune'    => $meta['rune'] ?? '',
                'url'     => self::url($page, $code, $params),
                'current' => $code === app()->getLocale(),
            ];
        }

        return $out;
    }

    /** A public asset URL carrying the file's modification time as its cache key. */
    public static function asset(string $path): string
    {
        $path = ltrim($path, '/');
        $file = public_path($path);
        $stamp = is_file($file) ? filemtime($file) : null;

        return url('/'.$path).($stamp ? '?v='.$stamp : '');
    }

    /** External links, with the empty ones already removed. */
    public static function links(): array
    {
        return array_filter((array) config('stvr.links', []), fn ($v) => filled($v));
    }

    public static function link(string $key): ?string
    {
        $value = config("stvr.links.{$key}");

        return filled($value) ? (string) $value : null;
    }

    /**
     * Pick a language for someone who arrived at "/".
     * Their browser already knows; asking it is more polite than guessing.
     */
    public static function negotiate(?string $acceptLanguage): string
    {
        $supported = self::locales();
        $best = self::fallback();
        $bestQuality = -1.0;

        foreach (explode(',', (string) $acceptLanguage) as $chunk) {
            $parts = explode(';', trim($chunk));
            $tag = strtolower(trim($parts[0]));

            if ($tag === '') {
                continue;
            }

            $quality = 1.0;

            foreach (array_slice($parts, 1) as $param) {
                if (str_starts_with(trim($param), 'q=')) {
                    $quality = (float) substr(trim($param), 2);
                }
            }

            $primary = explode('-', $tag)[0];

            if (in_array($primary, $supported, true) && $quality > $bestQuality) {
                $best = $primary;
                $bestQuality = $quality;
            }
        }

        return $best;
    }
}
