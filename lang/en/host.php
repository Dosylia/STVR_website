<?php

return [

    'meta' => [
        'title'       => 'Host a Skyrim VR multiplayer server · urSovngarde',
        'description' => 'Host a Skyrim VR co-op server with the launcher and a six-letter code, through our relay with no port to open, or by hand with port forwarding on UDP :port or a virtual LAN.',
    ],

    'hero' => [
        'kicker' => 'One executable · one UDP port · no account',
        'title'  => 'Running the server',
        'lede'   => 'The server is a program on a PC, and it belongs to whoever starts it. No account, no lobby, no matchmaker.',
    ],

    'launcher' => [
        'label' => 'The easy way',
        'title' => 'Hosting with the launcher',
        'steps' => [
            ['title' => 'Press Host a game',             'body' => 'The launcher starts the server that its install put next to the mod, waits until it is really running, and shows a six-letter code. You can set a password first.'],
            ['title' => 'Send the code',                 'body' => 'Friends type it under Join in their launcher, or press Join next to your name in their list of Steam friends.'],
            ['title' => 'Nothing to open on your router', 'body' => 'With launcher :relay_min or newer on both sides, the game goes through a relay of ours, live since :relay_since. It is new, so if a friend cannot connect, use one of the two ways under Networking below.'],
            ['title' => 'Stop hosting when you are done', 'body' => 'It takes the code down and closes the server.'],
        ],
    ],

    'start' => [
        'label' => 'By hand',
        'title' => 'Without the launcher',
        'steps' => [
            ['title' => 'Keep the Server folder somewhere', 'body' => 'Anywhere on the machine that will host. The server does not need the game installed, so an always-on box or a spare laptop works.'],
            ['title' => 'Run host-server.bat',             'body' => 'It refuses to start a second server, starts this one, and prints the address to hand out. A console window opens and says the port.'],
            ['title' => 'Leave the window open',           'body' => 'Closing it ends the session. On Windows 11 it may open as a tab in an existing Terminal. If you ever see two server tabs, close both and start again.'],
            ['title' => 'Watch people arrive',             'body' => 'The console prints <em>New player … connected</em>. That line is the fastest way to know a connection reached the server at all.'],
        ],
    ],

    'reach' => [
        'label' => 'Networking',
        'title' => 'Letting people reach you',
        'lede'  => 'With the launcher\'s relay you can usually skip this section. When it does not work for you, there are two ways, and the second one is easier.',

        'forward' => [
            'label' => 'Forward a port',
            'body'  => 'Forward <strong>:protocol :port</strong> in your router to the PC running the server, give the machine a static lease so the rule does not drift, and allow it through Windows Firewall. Then hand out your public address. You can find it at <code>api.ipify.org</code>, and your ISP may change it after a router reboot.',
            'rule'  => 'One line in Terminal (Administrator), once:',
            'cmd'   => 'New-NetFirewallRule -DisplayName "Skyrim Together Server (UDP :port)" -Direction Inbound -Protocol UDP -LocalPort :port -Action Allow -Profile Any',
        ],

        'vpn' => [
            'label' => 'Or skip the router',
            'body'  => 'Put everyone on a virtual LAN (Tailscale, ZeroTier or Radmin VPN) and hand out the address it gives you. No port forwarding, no public IP, nothing exposed to the internet, and it survives your ISP changing your address. For two or three friends this is almost always the right answer.',
        ],

        'self' => 'Hosting on the PC you play on is normal and supported. You connect to yourself at <code>127.0.0.1::port</code>, the same address as everyone else, minus the travel.',
    ],

    'settings' => [
        'label' => 'Configuration',
        'title' => 'Server settings',
        'lede'  => 'Edit <code>Server\\config\\STServer.ini</code> while the server is closed. These are the ones worth knowing.',
        'head'  => ['setting' => 'Setting', 'default' => 'Default', 'what' => 'What it does'],
        'rows'  => [
            ['k' => 'uPort',             'v' => ':port',  'd' => 'The UDP port players connect to. Change it and change the forwarding rule with it.'],
            ['k' => 'sPassword',         'v' => 'empty',  'd' => 'Set one to keep strangers out. Players put it on line two of their connect.txt.'],
            ['k' => 'bAutoPartyCreate',  'v' => 'true',   'd' => 'The first player on the server gets a party, so nobody has to find a party menu in VR.'],
            ['k' => 'bAutoPartyJoin',    'v' => 'true',   'd' => 'Everyone else joins it automatically. Needed for shared weather and quests.'],
            ['k' => 'bEnablePvp',        'v' => 'false',  'd' => 'Whether players can damage each other. Consider your friendships before changing this.'],
            ['k' => 'bEnableDeathSystem','v' => 'true',   'd' => 'Death respawns you at a temple instead of loading a save, which would desync the world.'],
            ['k' => 'bAllowMO2',         'v' => 'true',   'd' => 'Allows clients launched through Mod Organizer 2. Leave it on.'],
            ['k' => 'bAllowSKSE',        'v' => 'true',   'd' => 'Allows SKSE. Leave it on; nothing here works without it.'],
            ['k' => 'bEnableModCheck',   'v' => 'false',  'd' => 'Forces byte-identical modlists. Off by design. Close enough is close enough.'],
        ],
    ],

    'rules' => [
        'label' => 'Gotchas',
        'title' => 'Two rules that bite',
        'items' => [
            ['title' => 'Builds that speak the same messages connect', 'body' => 'Whatever their version number. A release that changes the network messages says so, and then everyone updates, the server included. A refused player is told both versions, in the game and in the launcher\'s loading screen.'],
            ['title' => 'uGridsToLoad stays at 5',      'body' => 'The server refuses any other value. It is the default of every list, so this only ever catches people who went tweaking.'],
        ],
    ],

    'linux' => [
        'title' => 'Linux',
        'body'  => 'The Linux build of the dedicated server does not build on the current code at the moment. It did before, and it is being fixed. Ask in the meantime.',
    ],

    'cta' => [
        'title'   => 'Server is up. Get everyone in',
        'body'    => 'Send them the address, the build, and the install guide.',
        'primary' => 'Install guide',
        'secondary' => 'Download the build',
    ],
];
