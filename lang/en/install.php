<?php

return [

    'meta' => [
        'title'       => 'Install Skyrim Together VR',
        'description' => 'Install Skyrim Together VR with Mod Organizer 2, a Wabbajack list, Vortex, or no mod manager at all. Prerequisites, connect.txt, first launch and updating.',
    ],

    'hero' => [
        'kicker' => 'Fifteen minutes, most of it downloading',
        'title'  => 'Putting it in',
        'lede'   => 'Pick how you manage mods. The rest is the same for everyone.',
    ],

    'prereq' => [
        'title' => 'First, the things that are not us',
        'lede'  => 'Install these exactly as you would any other SKSE mod. If Skyrim VR already runs with SKSE mods, most of this is done.',
        'items' => [
            ['name' => 'Skyrim VR :version',            'note' => 'The Steam VR executable. Special Edition will not do.',                              'state' => 'required'],
            ['name' => 'SKSE VR',                       'note' => 'Into Data, next to Skyrim.esm, like always.',                                        'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR', 'note' => 'The lookup table the mod reads to find anything in the game.',                       'state' => 'required'],
            ['name' => 'Engine Fixes VR',               'note' => 'Removes crashes that are the engine\'s, not ours.',                                  'state' => 'recommended'],
            ['name' => 'VRIK',                          'note' => 'Gives your character a body — which is the body your friend will see you move.',     'state' => 'recommended'],
        ],
        'ugrids' => 'One setting matters: <code>uGridsToLoad</code> must be <code>5</code> in <code>SkyrimPrefs.ini</code>. It is the default everywhere, including every Wabbajack list, and the server refuses any other value — with a different number of cells loaded, the two worlds would quietly stop agreeing about what exists.',
    ],

    'methods' => [
        'title' => 'Then, the mod',
        'lede'  => 'Three routes to the same place. Mod Organizer 2 is the one the developers use.',

        'mo2' => [
            'label' => 'Mod Organizer 2',
            'note'  => 'Also Wabbajack lists: FUS, Mad God\'s Overhaul, your own.',
            'steps' => [
                ['title' => 'Install the mod folder',  'body' => 'Drag the <code>Skyrim Together mod</code> folder onto the MO2 mod list, or zip it and use <em>Install a new mod</em>. Tick it.'],
                ['title' => 'Enable the plugin',       'body' => 'Tick <code>SkyrimTogether.esp</code> in the plugin list on the right.'],
                ['title' => 'Place the launcher',      'body' => 'Copy the <code>Skyrim Together VR</code> folder into your list\'s <code>tools\\</code> folder. Anywhere works; <code>tools\\</code> keeps it tidy.'],
                ['title' => 'Add it as an executable', 'body' => 'In MO2, the gear icon next to <em>Run</em> → <strong>+</strong> → <em>Add from file</em> → <code>SkyrimTogetherVR.exe</code>. Apply. From now on you start the game with that, not with SKSE.'],
            ],
        ],

        'vortex' => [
            'label' => 'Vortex',
            'note'  => 'Works fine. MO2 is just what was tested.',
            'steps' => [
                ['title' => 'Install the SKSE mods normally', 'body' => 'SKSE VR, the VR Address Library, Engine Fixes VR and VRIK go in through Vortex like any other mod.'],
                ['title' => 'Install the co-op mod',          'body' => 'Zip the <code>Skyrim Together mod</code> folder (right click → Send to → Compressed folder), then <em>Mods → Install From File</em>, pick the zip, enable it. Tick <code>SkyrimTogether.esp</code> in Plugins. Deploy if asked.'],
                ['title' => 'Place the launcher',             'body' => 'Put the <code>Skyrim Together VR</code> folder next to <code>SkyrimVR.exe</code>. <strong>Not</strong> inside <code>Data</code>.'],
                ['title' => 'Launch from it',                 'body' => 'Start <code>SkyrimTogetherVR.exe</code> directly, or add it on the Vortex dashboard with <em>Add Tool</em>. Never start the SKSE loader yourself — the launcher starts the game and loads SKSE for you.'],
            ],
            'warnings' => [
                '<strong>Purge</strong> in Vortex strips every deployed mod out of <code>Data</code>, this one included. Deploy again before you play.',
                'Vortex needs the game and its staging folder on the same drive for hardlinks. That is a Vortex rule, not ours — fix it there if it complains.',
            ],
        ],

        'manual' => [
            'label' => 'No mod manager',
            'note'  => 'Perfectly fine. Just be the mod manager yourself.',
            'steps' => [
                ['title' => 'Copy the mod in',    'body' => 'Everything inside <code>Skyrim Together mod</code> goes into <code>Skyrim VR\\Data</code>, next to <code>Skyrim.esm</code>. Enable <code>SkyrimTogether.esp</code> on the Mods screen in the game.'],
                ['title' => 'Place the launcher', 'body' => 'Put the <code>Skyrim Together VR</code> folder anywhere — inside the Skyrim VR folder is a reasonable place.'],
                ['title' => 'Launch from it',     'body' => 'Start the game with <code>SkyrimTogetherVR.exe</code> from that folder, not with SKSE. The first launch asks where Skyrim VR is installed.'],
            ],
        ],
    ],

    'connect' => [
        'title' => 'Point it at a server',
        'lede'  => 'The client reads one small text file to know where to go. You write it once.',
        'easy'  => 'The easy way: double-click <code>setup-connect.bat</code> in the <code>Skyrim Together VR</code> folder and type the address.',
        'manual'=> 'By hand: create <code>:path</code> and put the address on line one, and the server password — if there is one — on line two.',
        'table' => [
            'who'  => 'Who you are',
            'line1'=> 'Line 1',
            'line2'=> 'Line 2',
            'host' => 'Hosting on the same PC you play on',
            'host1'=> '127.0.0.1::port',
            'friend'=> 'Joining someone else',
            'friend1'=> '<their address>::port',
            'pass' => 'The password, if the server has one',
            'none' => 'Leave empty',
        ],
        'warning' => 'Just the address. No <code>http://</code>, no quotes, no trailing spaces.',
    ],

    'first' => [
        'title' => 'First session',
        'steps' => [
            ['title' => 'Someone starts a server', 'body' => 'The host runs <code>host-server.bat</code> and leaves the window open. See the hosting guide if that is you.'],
            ['title' => 'Everyone launches',       'body' => 'Through MO2, through Vortex, or straight from the exe. With a heavy modlist, give it time.'],
            ['title' => 'Load a save',             'body' => 'Any save. About five seconds later you will see <em>Skyrim Together: connecting…</em> and then <em>connected (build …)</em>. The party forms itself; nobody has to invite anybody.'],
            ['title' => 'Play',                    'body' => 'The SteamVR dashboard has a <strong>Skyrim Together</strong> tab — press the system button, point the laser. <code>:key</code> disconnects and reconnects without leaving the game.'],
        ],
    ],

    'update' => [
        'label' => 'Keeping current',
        'title' => 'Updating',
        'body'  => 'Close the game. Drag the update zip onto <code>update.bat</code> in the <code>Skyrim Together VR</code> folder. It swaps the files without closing MO2. By hand, that is <code>SkyrimTogetherVR.exe</code> and <code>SkyrimTogetherVR.pdb</code> replaced in place.',
        'warn'  => 'Everyone must be on the same build, server included. A mismatch is refused at connect, and the message names both versions so you know who is behind.',
    ],

    'trouble' => [
        'label' => 'Troubleshooting',
        'title' => 'When it does not work',
        'lede'  => 'In rough order of how often it is each one.',
        'items' => [
            ['q' => 'It never connects',                  'a' => 'Check <code>connect.txt</code> first: right address, right port, nothing extra on the line. Then check the server window is actually open on the host\'s PC — it prints a line every time someone connects.'],
            ['q' => 'Refused the moment it tries',        'a' => 'That is deliberate. The notification says why: a build mismatch or a wrong password. Builds must match exactly, server included.'],
            ['q' => 'He sees a bear, I see a wolf',       'a' => 'Different load orders. Get both modlists as close to identical as you can — same list, same version, same optional mods.'],
            ['q' => 'The game crashes',                   'a' => 'Run <code>collect-logs.bat</code> in the launcher folder. It puts a zip on your Desktop with the log, the crash dump and the versions. Send that; it is the difference between a fix and a guess.'],
            ['q' => 'It launches without SKSE mods',      'a' => 'You started the SKSE loader instead of <code>SkyrimTogetherVR.exe</code>. The launcher loads SKSE itself — go through it, not around it.'],
        ],
    ],

    'cta' => [
        'title' => 'Someone has to run the server',
        'body'  => 'It is one executable and one UDP port — or no port at all, if you would rather use a virtual LAN.',
        'primary' => 'Hosting guide',
    ],
];
