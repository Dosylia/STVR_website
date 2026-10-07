<?php

namespace App\Support;

/**
 * The launcher, served by this site itself (Emma, 2026-10-07): the download
 * button gives the file in public/downloads/launcher, straight away, with no
 * GitHub page on the way. A new version is published by dropping its file in
 * that folder (and taking the old one out). Should several be there, the
 * highest name wins, so urSovngarde_0.2.0 beats urSovngarde_0.1.0 on any
 * server, whatever dates the files carry after a deploy.
 */
final class LauncherDownload
{
    public function current(): ?ReleaseAsset
    {
        $folder = trim((string) config('stvr.launcher.folder'), '/');
        $types = array_map('strtolower', (array) config('stvr.launcher.types', []));
        $files = glob(public_path($folder).'/*') ?: [];

        $files = array_values(array_filter(
            $files,
            fn (string $path) => is_file($path) && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), $types, true),
        ));

        if ($files === []) {
            return null;
        }

        usort($files, fn (string $a, string $b) => strnatcasecmp(basename($b), basename($a)));
        $name = basename($files[0]);

        return new ReleaseAsset(
            name: $name,
            url: asset($folder.'/'.rawurlencode($name)),
            size: (int) filesize($files[0]),
            kind: 'launcher',
        );
    }
}
