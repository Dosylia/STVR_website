<?php

namespace App\Support;

/** One launcher file this site serves, with what installed launchers need to update to it. */
final class LauncherBuild
{
    public function __construct(
        public readonly string $name,
        /** "0.2.0", read from the file name Tauri gives it (urSovngarde_0.2.0_x64-setup.exe). */
        public readonly ?string $version,
        public readonly int $size,
        /** The .sig GitHub made with Emma's key: installed launchers refuse the file without it. */
        public readonly string $signature,
        public readonly ?string $notes,
        public readonly ?string $publishedAt,
    ) {
    }
}
