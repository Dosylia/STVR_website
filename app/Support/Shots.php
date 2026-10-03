<?php

namespace App\Support;

/**
 * Screenshots, if there are any.
 *
 * The site was designed without them on purpose. There was nothing to show
 * when it was built, and a page that only works once somebody remembers to take
 * a screenshot is a page that stays unfinished. So the gallery reads whatever is
 * in public/media/shots and renders it; with an empty folder the section falls
 * back to the illustration and still reads as deliberate.
 *
 * Dropping a file in is the whole workflow. No build step, no config entry, no
 * deploy: name it `NN-slug.jpg` (the number orders it, the slug names it) and it
 * appears. A caption is optional: add one under the same slug in
 * lang/<locale>/shots.php and it shows up; leave it out and the image stands on
 * its own.
 */
final class Shots
{
    private const DIRECTORY = 'media/shots';
    private const EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp', 'avif'];

    /** @return array<int, array{slug: string, url: string, caption: ?string, alt: string}> */
    public function all(): array
    {
        $directory = public_path(self::DIRECTORY);

        if (! is_dir($directory)) {
            return [];
        }

        $files = glob($directory.'/*.{'.implode(',', self::EXTENSIONS).'}', GLOB_BRACE) ?: [];

        sort($files, SORT_NATURAL);

        return array_values(array_map(function (string $path) {
            $file = basename($path);
            // "03-riften-market.jpg" -> "riften-market"
            $slug = preg_replace('/^\d+[-_]?/', '', pathinfo($file, PATHINFO_FILENAME)) ?: $file;
            $caption = __('shots.captions.'.$slug);

            // Laravel returns the key itself when a translation is missing.
            $caption = str_starts_with($caption, 'shots.captions.') ? null : $caption;

            return [
                'slug'    => $slug,
                'url'     => Nav::asset(self::DIRECTORY.'/'.$file),
                'caption' => $caption,
                'alt'     => $caption ?: str_replace('-', ' ', $slug),
            ];
        }, $files));
    }

    public function any(): bool
    {
        return $this->all() !== [];
    }
}
