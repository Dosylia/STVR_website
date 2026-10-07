<?php

/**
 * Everything about this site that is a fact rather than a layout lives here.
 *
 * The rule: no URL, version number, port or project name is ever typed into a
 * Blade view or a translation string. Translators change wording, not facts, and
 * a new Discord invite is a one-line change in .env rather than a hunt through
 * four languages.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Identity
    |--------------------------------------------------------------------------
    */
    'name'       => 'urSovngarde',
    'short_name' => 'urSovngarde',
    'tagline_key' => 'site.tagline',

    /*
    |--------------------------------------------------------------------------
    | Links
    |--------------------------------------------------------------------------
    | An empty string hides the link everywhere it would otherwise appear, so
    | the Discord and Nexus buttons simply do not exist until you set them.
    */
    'links' => [
        'github'        => env('STVR_GITHUB_URL', 'https://github.com/Dosylia/SkyrimTogetherVR'),
        'issues'        => env('STVR_ISSUES_URL', 'https://github.com/Dosylia/SkyrimTogetherVR/issues'),
        'releases'      => env('STVR_RELEASES_URL', 'https://github.com/Dosylia/SkyrimTogetherVR/releases'),
        'discord'       => env('STVR_DISCORD_URL', ''),
        'nexus'         => env('STVR_NEXUS_URL', ''),
        'upstream'      => 'https://github.com/tiltedphoques/TiltedEvolution',
        'upstream_site' => 'https://skyrim-together.com',
        'licence'       => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
        'skse'          => 'https://skse.silverlock.org/',
        'address_lib'   => 'https://www.nexusmods.com/skyrimspecialedition/mods/58101',
        'vrik'          => 'https://www.nexusmods.com/skyrimspecialedition/mods/23416',
        'engine_fixes'  => 'https://www.nexusmods.com/skyrimspecialedition/mods/32444',
        'fus'           => 'https://www.nexusmods.com/skyrimspecialedition/mods/98610',
    ],

    /*
    |--------------------------------------------------------------------------
    | GitHub release feed
    |--------------------------------------------------------------------------
    | The download panel reads the newest published release straight from the
    | GitHub API so a new tag updates the site on its own. Until a release is
    | published the fallback below is shown instead, and the download buttons
    | point at whatever `fallback.url` says.
    |
    | A token is optional. Without one GitHub allows 60 requests an hour per IP,
    | and the response is cached for `cache_minutes`, so one small site will
    | never come close.
    */
    /*
    |--------------------------------------------------------------------------
    | The launcher
    |--------------------------------------------------------------------------
    |
    | GitHub builds it at every push to its repository and releases it when
    | its version goes up; this site keeps a copy of the newest release and
    | serves it under its own address (App\Support\LauncherDownload), to the
    | download button and to installed launchers updating themselves. The
    | repository can stay private: the token only needs to read its contents.
    |
    */

    'launcher' => [
        'repo'  => env('STVR_LAUNCHER_REPO', 'Dosylia/urSovngarde-launcher'),
        'token' => env('STVR_LAUNCHER_TOKEN', ''),
    ],

    'github' => [
        'repo'          => env('STVR_GITHUB_REPO', 'Dosylia/SkyrimTogetherVR'),
        'token'         => env('STVR_GITHUB_TOKEN', ''),
        'cache_minutes' => (int) env('STVR_RELEASE_CACHE_MINUTES', 30),
        'timeout'       => 6,

        // Shown when GitHub has no published release yet, or is unreachable.
        'fallback' => [
            'tag'          => env('STVR_FALLBACK_TAG', ''),
            'published_at' => env('STVR_FALLBACK_DATE', ''),
            'url'          => env('STVR_FALLBACK_URL', ''),
            'full_size'    => env('STVR_FALLBACK_FULL_SIZE', ''),
            'patch_size'   => env('STVR_FALLBACK_PATCH_SIZE', ''),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | How an asset filename is classified in the download panel
    |--------------------------------------------------------------------------
    | make-release.ps1 emits SkyrimTogetherVR-standalone-<version>.zip,
    | SkyrimTogetherVR-<version>-update.zip and
    | SkyrimTogetherVR-<version>-server-update.zip. Order matters: first match
    | wins, so "server" comes before the update rule, or the server's zip
    | would be taken for the client update.
    */
    'asset_kinds' => [
        'launcher' => ['ursovngarde_', '-setup.exe', '.msi'],
        'server' => ['server'],
        'patch'  => ['-update.zip', '-patch.zip'],
        'full'   => ['.zip'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hard facts the copy refers to
    |--------------------------------------------------------------------------
    */
    'facts' => [
        'port'          => 10578,
        'protocol'      => 'UDP',
        'game'          => 'Skyrim VR',
        'game_version'  => '1.4.15',
        'ugrids'        => 5,
        'toggle_key'    => 'F6',
        'licence'       => 'GPL-3.0',
        'connect_file'  => '%LOCALAPPDATA%\\SkyrimTogetherVR\\connect.txt',
    ],

    /*
    |--------------------------------------------------------------------------
    | Crash reports
    |--------------------------------------------------------------------------
    | What the privacy page promises about the reports the launcher sends. The
    | hub deletes a report this many days after it arrives (its KV expiry), and
    | the triage deletes its downloaded copies on the same day.
    */
    'reports' => [
        'keep_days' => 90,
    ],

    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    | `name` is written in the language itself. Nobody looking for German wants
    | to scan a list that says "German". `tag` is the BCP-47 value for <html lang>
    | and hreflang.
    */
    'locales' => [
        'en' => ['name' => 'English',  'tag' => 'en', 'short' => 'EN', 'rune' => 'ᛖ'],
        'fr' => ['name' => 'Français', 'tag' => 'fr', 'short' => 'FR', 'rune' => 'ᚠ'],
        'de' => ['name' => 'Deutsch',  'tag' => 'de', 'short' => 'DE', 'rune' => 'ᛞ'],
        'es' => ['name' => 'Español',  'tag' => 'es', 'short' => 'ES', 'rune' => 'ᛊ'],
    ],
    /*
    |--------------------------------------------------------------------------
    | URL slugs, per language
    |--------------------------------------------------------------------------
    | A French visitor gets /fr/installation, not /fr/install. It costs one table
    | and it is the difference between a site translated and a site that was only
    | ever written in English. Keys are page ids used throughout the code; never
    | rename a key without also changing every Nav::url() call.
    */
    'paths' => [
        'home'     => ['en' => '',         'fr' => '',             'de' => '',          'es' => ''],
        'download' => ['en' => 'download', 'fr' => 'telecharger',  'de' => 'download',  'es' => 'descargar'],
        'install'  => ['en' => 'install',  'fr' => 'installation', 'de' => 'anleitung', 'es' => 'instalacion'],
        'host'     => ['en' => 'host',     'fr' => 'heberger',     'de' => 'server',    'es' => 'servidor'],
        'faq'      => ['en' => 'faq',      'fr' => 'faq',          'de' => 'faq',       'es' => 'faq'],
        'roadmap'  => ['en' => 'roadmap',  'fr' => 'feuille-de-route', 'de' => 'fahrplan', 'es' => 'hoja-de-ruta'],
        'devlog'   => ['en' => 'devlog',   'fr' => 'journal',      'de' => 'entwicklertagebuch', 'es' => 'diario'],
        'privacy'  => ['en' => 'privacy',  'fr' => 'confidentialite', 'de' => 'datenschutz', 'es' => 'privacidad'],
    ],

    'fallback_locale' => 'en',
];
