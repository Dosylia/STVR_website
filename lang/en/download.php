<?php

return [

    'meta' => [
        'title'       => 'Download urSovngarde',
        'description' => 'Get the latest urSovngarde build: the full package for a first install, or the small update zip if you already have it.',
    ],

    'hero' => [
        'kicker' => 'Free · GPLv3 · no account',
        'title'  => 'Take the build',
        'lede'   => 'Two files. The big one the first time, the small one every time after that.',
    ],

    'release' => [
        'label'          => 'The build',
        'live_label'     => 'Latest release',
        'current'        => 'The current build',
        'published'      => 'Published :date',
        'unknown_date'   => 'Freshly cut',
        'downloads'      => ':count downloads',
        'notes'          => 'Release notes',
        'notes_on_github'=> 'Full notes on GitHub',
        'mirror'         => 'All releases',
    ],

    'state' => [
        'fallback_title' => 'Served from GitHub',
        'fallback_body'  => 'The newest build is always on the releases page. This panel fills in with version, date and size the moment a tagged release is published.',
        'none_title'     => 'The first public build is being packaged',
        'none_body'      => 'Nothing to download here yet. The source is public in the meantime, and the devlog is where the work shows up first.',
    ],

    'assets' => [
        'full' => [
            'title' => 'Full package',
            'body'  => 'Everything: the mod folder, the launcher, the server, and the four install guides. This is the one you want the first time.',
            'meta'  => 'First install',
        ],
        'patch' => [
            'title' => 'Update only',
            'body'  => 'Just the client executable and its symbols. Drag it onto update.bat in your launcher folder and you are done. Small enough to post in a chat.',
            'meta'  => 'Already installed',
        ],
        'server' => [
            'title' => 'Server',
            'body'  => 'The dedicated server on its own, for a machine that does not have the game. A Linux build exists too. Ask.',
            'meta'  => 'Hosts only',
        ],
        'download_cta' => 'Download',
        'size'         => 'Size',
    ],

    'requires' => [
        'label' => 'Prerequisites',
        'title' => 'Before you click',
        'lede'  => 'None of this is optional except where it says so.',
        'items' => [
            ['name' => 'Skyrim VR :version',             'note' => 'The Steam version. Not Special Edition, not Anniversary: the VR executable.', 'state' => 'required'],
            ['name' => 'SKSE VR',                        'note' => 'The script extender build for VR. Installed into Data like any SKSE mod.',        'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR',  'note' => 'What lets the mod find anything inside the game at all.',                         'state' => 'required'],
            ['name' => 'uGridsToLoad = 5',               'note' => 'The default. The server refuses anything else, because the world would not line up.', 'state' => 'required'],
            ['name' => 'Engine Fixes VR',                'note' => 'Stops a category of crash that has nothing to do with us.',                       'state' => 'recommended'],
            ['name' => 'VRIK',                           'note' => 'The body your friend sees. Strongly recommended. This is most of the point.',    'state' => 'recommended'],
            ['name' => 'The same build as your friends', 'note' => 'The server refuses a mismatch and names both versions when it does.',             'state' => 'required'],
        ],
    ],

    'next' => [
        'label' => 'Next',
        'title' => 'Downloaded. Now what',
        'install' => ['title' => 'Install it',   'body' => 'MO2, Vortex, a Wabbajack list, or no manager at all. The guide covers all four.', 'cta' => 'Install guide'],
        'host'    => ['title' => 'Host it',      'body' => 'One executable, one UDP port, or a virtual LAN and no router at all.',            'cta' => 'Hosting guide'],
        'issues'  => ['title' => 'When it breaks', 'body' => 'Run collect-logs.bat and send the zip. It gathers the log, the dump and the versions.', 'cta' => 'Report a bug'],
    ],

    'safety' => [
        'label' => 'Trust',
        'title' => 'A word on trust',
        'body'  => 'The launcher replaces the game executable in memory to do its work, which is exactly the shape of a thing you should be suspicious of. So: every line of this is on GitHub, the licence requires it to stay that way, and the build you download is made by a script in that same repository. If you would rather compile it yourself, that is a supported answer.',
        'cta'   => 'Read the source',
    ],
];
