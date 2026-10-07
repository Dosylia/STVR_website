<?php

namespace App\Http\Controllers;

use App\Support\LauncherDownload;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/** The launcher file and the note installed launchers read to update themselves (App\Support\LauncherDownload). */
class LauncherController extends Controller
{
    public function __construct(private readonly LauncherDownload $launcher)
    {
    }

    public function file(string $name): StreamedResponse
    {
        $path = $this->launcher->stored($name) ?? abort(404);

        return Storage::disk('local')->download($path, $name, ['Content-Type' => 'application/octet-stream']);
    }

    /** What Tauri's updater reads (its static JSON form): the version, and where the signed file is. */
    public function latest(): JsonResponse
    {
        $build = $this->launcher->current();

        if ($build === null || $build->version === null) {
            abort(404);
        }

        return response()->json([
            'version'   => $build->version,
            'notes'     => $build->notes ?? '',
            'pub_date'  => $build->publishedAt,
            'platforms' => [
                'windows-x86_64' => [
                    'signature' => $build->signature,
                    'url'       => route('launcher.file', ['name' => $build->name]),
                ],
            ],
        ])->header('Cache-Control', 'no-cache');
    }
}
