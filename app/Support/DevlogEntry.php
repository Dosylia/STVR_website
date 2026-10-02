<?php

namespace App\Support;

use Illuminate\Support\Str;

final class DevlogEntry
{
    /** @param  array<int, string>  $tags */
    public function __construct(
        public readonly string $slug,
        public readonly string $title,
        public readonly \DateTimeImmutable $date,
        public readonly string $summary,
        public readonly array $tags,
        public readonly string $markdown,
        /** True when this entry had no translation and the English text is being shown. */
        public readonly bool $translated = true,
    ) {
    }

    public function html(): string
    {
        return Str::markdown($this->markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    /** Rough minutes-to-read, used as a small honest signal next to long entries. */
    public function readingMinutes(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($this->markdown)) / 200));
    }
}
