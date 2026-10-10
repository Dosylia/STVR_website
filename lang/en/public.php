<?php

return [

    'meta' => [
        'title'       => 'Public Skyrim VR server · urSovngarde',
        'description' => 'A urSovngarde server anyone can join: who is on it right now, where they are on the map, and how to join.',
    ],

    'hero' => [
        'kicker' => 'Open to anyone · no invite code',
        'title'  => 'The public server',
        'lede'   => 'A server we keep running for anyone with the mod. Look who is on it, see where they are, and join in.',
    ],

    // Shown instead of everything below while the server or its status is not live.
    'closed' => [
        'title' => 'Not open yet',
        'body'  => 'The public server is being built. Until it opens, play with friends: host a game in the launcher and send them its six-letter code.',
        'cta'   => 'Host your own',
        'sample' => 'Development preview: the server on this page is made up.',
    ],

    'status' => [
        'label'    => 'Right now',
        'online'   => 'Online',
        'offline'  => 'Offline',
        'offline_body' => 'The server is not answering at the moment. It may be restarting for an update; look again in a few minutes.',
        'players'  => 'Players',
        'of'       => ':count of :max',
        'address'  => 'Address',
        'version'  => 'Build',
        'protocol' => 'Message set',
        'password' => 'Password',
        'password_yes' => 'Yes, ask on Discord',
        'password_no'  => 'None',
        'up_since' => 'Up since',
        'updated'  => 'Status from :time',
    ],

    'join' => [
        'label' => 'Joining',
        'title' => 'How to join',
        'steps' => [
            ['title' => 'Have a build that speaks its messages', 'body' => 'The server runs build :version, message set :protocol. Any build with the same message set connects, so a nearby version often works too. If yours is refused, the launcher says both versions, and the download page has the right one.'],
            ['title' => 'Put in the address',  'body' => 'In the launcher, open Join, choose "or an address" and paste the address above. Without the launcher, put it on the first line of your connect.txt.'],
            ['title' => 'Load any save',       'body' => 'The game joins the server a few seconds after the save loads. Your character and your save stay yours.'],
        ],
        'copy' => 'Copy the address',
        'button' => 'Join with the launcher',
        'button_note' => 'The launcher asks before it joins. If nothing happens, update the launcher: older ones do not know this link.',
    ],

    'who' => [
        'label' => 'On the server',
        'title' => 'Who is here',
        'none'  => 'Nobody is on right now. Be the first.',
        'inside' => 'Indoors',
        'note'  => 'Character names, as the players set them in game, and places in each player\'s own game language. Indoors, a player is listed without a dot on the map.',
        'hidden' => '{1} And one more player, not listed.|[2,*] And :count more players, not listed.',
        'hide' => 'Want to stay off this page? In the launcher: "Hide me from the public server page".',
    ],

    'map' => [
        'label'  => 'Where they are',
        'title'  => 'The map',
        'note'   => 'Refreshed every :seconds seconds while you watch. Our own drawings, close enough to say "near Riverwood".',
        'switch' => 'Choose a map',
        'title_solstheim' => 'Map of Solstheim with the players on the public server',
        'red_mountain' => 'Red Mountain',
        // The areas a player can be outdoors in (config stvr.public_server.areas). Skyrim and Solstheim have a map.
        'areas'  => [
            'skyrim'         => 'Skyrim',
            'solstheim'      => 'Solstheim',
            'blackreach'     => 'Blackreach',
            'sovngarde'      => 'Sovngarde',
            'skuldafn'       => 'Skuldafn',
            'soul_cairn'     => 'Soul Cairn',
            'forgotten_vale' => 'Forgotten Vale',
            'apocrypha'      => 'Apocrypha',
            'deepwood_vale'  => 'Deepwood Vale',
        ],
        'solstheim' => [
            'raven_rock'    => 'Raven Rock',
            'skaal_village' => 'Skaal Village',
            'thirsk'        => 'Thirsk Mead Hall',
            'tel_mithryn'   => 'Tel Mithryn',
            'karstaag'      => 'Castle Karstaag',
            'miraak'        => 'Temple of Miraak',
            'frostmoth'     => 'Fort Frostmoth',
            'kolbjorn'      => 'Kolbjorn Barrow',
        ],
        'sea'    => 'Sea of Ghosts',
        'throat' => 'Throat of the World',
        'towns'  => [
            'solitude'   => 'Solitude',
            'morthal'    => 'Morthal',
            'dawnstar'   => 'Dawnstar',
            'winterhold' => 'Winterhold',
            'windhelm'   => 'Windhelm',
            'whiterun'   => 'Whiterun',
            'markarth'   => 'Markarth',
            'falkreath'  => 'Falkreath',
            'riften'     => 'Riften',
            'riverwood'  => 'Riverwood',
            'helgen'     => 'Helgen',
            'ivarstead'  => 'Ivarstead',
        ],
        'title_svg' => 'Map of Skyrim with the players on the public server',
    ],

    'rules' => [
        'label' => 'House rules',
        'title' => 'Play nicely',
        'items' => [
            'It is a shared world, and an early one: things will drift out of step. Say so on Discord when they do.',
            'No griefing, no harassment.',
            'Report a crash from the launcher. Report a person on our Discord.',
        ],
    ],

    'cta' => [
        'title'   => 'Rather play with your own group?',
        'body'    => 'Host a game in the launcher, send a six-letter code, and the world is yours.',
        'primary' => 'Host a server',
        'secondary' => 'Download the launcher',
    ],
];
