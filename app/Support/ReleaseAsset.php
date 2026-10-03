<?php

namespace App\Support;

final class ReleaseAsset
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
        public readonly int $size,
        public readonly string $kind,
        public readonly int $downloads = 0,
    ) {
    }

    /** "412 MB". Binary units, one decimal only where it earns its place. */
    public function humanSize(): string
    {
        if ($this->size <= 0) {
            return '';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $value = (float) $this->size;
        $unit = 0;

        while ($value >= 1024 && $unit < count($units) - 1) {
            $value /= 1024;
            $unit++;
        }

        return $value >= 100 || $unit <= 1
            ? number_format($value, 0).' '.$units[$unit]
            : number_format($value, 1).' '.$units[$unit];
    }
}
