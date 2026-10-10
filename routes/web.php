<?php

use App\Http\Controllers\DevlogController;
use App\Http\Controllers\LauncherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeoController;
use App\Support\Nav;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
| One tree per language, with the path segments taken from config('stvr.paths'),
| so /fr/installation and /de/anleitung are the same page as /en/install. The
| routes are registered explicitly rather than behind a catch-all: a wrong URL
| then 404s instead of rendering the home page at a thousand different
| addresses, which search engines punish and visitors find confusing.
*/

Route::get('/', [PageController::class, 'root'])->name('root');

Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

// The launcher, from this site's copy of its newest GitHub release (App\Support\LauncherDownload): the file, and
// the note installed launchers read to update themselves.
Route::get('/downloads/launcher/latest.json', [LauncherController::class, 'latest'])->name('launcher.latest');
Route::get('/downloads/launcher/{name}', [LauncherController::class, 'file'])
    ->where('name', '[A-Za-z0-9._-]+')
    ->name('launcher.file');

$pages = [
    'download' => 'download',
    'install'  => 'install',
    'host'     => 'host',
    'faq'      => 'faq',
    'roadmap'  => 'roadmap',
    'privacy'  => 'privacy',
    'legal'    => 'legal',
    'public'   => 'publicServer',
];

foreach (Nav::locales() as $locale) {
    Route::get("/{$locale}", [PageController::class, 'home'])->name("{$locale}.home");

    foreach ($pages as $page => $method) {
        $segment = (string) config("stvr.paths.{$page}.{$locale}", $page);

        Route::get("/{$locale}/{$segment}", [PageController::class, $method])
            ->name("{$locale}.{$page}");
    }

    $devlog = (string) config("stvr.paths.devlog.{$locale}", 'devlog');

    Route::get("/{$locale}/{$devlog}", [DevlogController::class, 'index'])->name("{$locale}.devlog");
    Route::get("/{$locale}/{$devlog}/{slug}", [DevlogController::class, 'show'])->name("{$locale}.devlog.show");
}
