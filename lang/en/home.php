<?php

return [

    'meta' => [
        'title'       => 'Skyrim VR Multiplayer & Co-op Mod · urSovngarde',
        'description' => 'Play Skyrim VR multiplayer with friends: a free, open-source co-op mod. Your modlist, your save, your server, and a friend beside you with their real hands.',
    ],

    'hero' => [
        'kicker'   => 'Skyrim VR multiplayer · co-op mod · open source',
        'title'    => 'You are not the only Dragonborn anymore',
        'lede'     => 'Multiplayer co-op for Skyrim VR. Your modlist, your save, your server, and someone else actually in the room with you, at their own height, with their own hands.',
        'primary'  => 'Download the launcher',
        'secondary'=> 'How to install it',
        'scroll'   => 'Keep reading',
        'caption'  => 'Two on the ridge. One of them is not an NPC.',
    ],

    'stats' => [
        'version_label'  => 'Current build',
        'version_none'   => 'In packaging',
        'version_rolling'=> 'Latest build',
        'port_label'     => 'Your server, your port',
        'port_note'      => 'UDP, forwarded or over a VPN',
        'game_label'     => 'Runs on',
        'game_value'     => 'Skyrim VR :version',
        'game_note'      => 'SKSE VR and the VR Address Library',
        'price_label'    => 'Price',
        'price_value'    => 'Free, forever',
        'price_note'     => 'GPLv3, source in the open',
    ],

    'plain' => [
        'label' => 'Plainly',
        'title' => 'What this actually is',
        'body'  => 'Skyrim Together Reborn put co-op into Skyrim Special Edition. Skyrim VR is a different executable: different memory addresses, different engine classes, a body where there used to be a camera. This is that mod, taken apart and put back together for the VR build, by two full-stack developers who learned C++ and reverse engineering on the way, which is either reassuring or alarming depending on your temperament.',
        'body2' => 'It is free, the source is public, and it never talks to a server we own. You host, or your friend hosts. Nobody signs up for anything.',
    ],

    'features' => [
        'label'  => 'What it does',
        'title'  => 'Everything here is in the build you can download',
        'lede'   => 'Everything below is in the build you can download today. What is not there yet is on the roadmap, named.',

        'items' => [
            [
                'rune'  => 'ᛗ',
                'title' => 'They are really there',
                'body'  => 'Head, hands and hips go across the wire. With VRIK installed, your friend has a body, so when they lean around a corner to look, you watch them lean. When they point, you can follow the arm. Not a floating helmet. A person.',
            ],
            [
                'rune'  => 'ᛟ',
                'title' => 'A menu that belongs in VR',
                'body'  => 'The mod lives on its own tab in the SteamVR dashboard: laser pointer, SteamVR keyboard, read at a comfortable distance. Press F6 in-game to connect or disconnect without taking the headset off.',
            ],
            [
                'rune'  => 'ᚦ',
                'title' => 'Your modlist, untouched',
                'body'  => 'Mod Organizer 2, Vortex, a Wabbajack list like FUS, or no manager at all. Your load order stays your load order. The launcher starts the game and loads SKSE for you. You never touch the SKSE loader again.',
            ],
            [
                'rune'  => 'ᛒ',
                'title' => 'One world, not two',
                'body'  => 'Quests, weather and time of day are shared through the party, and the party forms itself the moment you both connect. A dropped item falls to the same floor in both headsets, and follows the hand that threw it on the way down.',
            ],
            [
                'rune'  => 'ᚾ',
                'title' => 'Your server, your rules',
                'body'  => 'One executable and a UDP port. Forward it, or put everyone on Tailscale, ZeroTier or Radmin and skip the router entirely. Set a password, turn PvP on, decide what death costs. There is no lobby, no matchmaker and no account.',
            ],
            [
                'rune'  => 'ᛉ',
                'title' => 'It reconnects on its own',
                'body'  => 'A dropped connection retries after 5 seconds, then 10, 20, 30 and 60, and tells you so on screen. A refused one does not retry and says why (wrong build, wrong password) instead of leaving you staring at a loading door.',
            ],
        ],
    ],

    'honest' => [
        'label' => 'The other half of the truth',
        'title' => 'And it will break',
        'body'  => 'This is a mod of a mod of a game engine, pushed into a headset. It crashes. NPCs occasionally fall through floors. A body dragged in one world sometimes stays put in the other. We keep a known-issues list that is specific rather than apologetic, a devlog that admits when a diagnosis was wrong, and a batch file that bundles your logs and crash dump into one zip you can hand to us.',
        'cta_roadmap' => 'See what is broken',
        'cta_devlog'  => 'Read the devlog',
    ],

    'tips' => [
        'label' => 'From the loading screen',
        'items' => [
            'The server refuses any client whose build does not match. The connect notification names both versions, so a mismatch takes ten seconds to diagnose.',
            'uGridsToLoad must be 5. It is the default of every Wabbajack list, and the server will not take anything else.',
            'VRIK is what gives your friend a body. Without it they are still there, with rather less of them to see.',
            'The host connects to their own server at 127.0.0.1, the same address as everyone else, minus the travel.',
            'Both of you should run the same modlist. "He sees a bear, I see a wolf" is almost always two different load orders.',
        ],
    ],

    'steps' => [
        'label' => 'Getting in',
        'title' => 'From nothing to playing',
        'lede'  => 'Four steps, and the launcher does most of them.',
        'items' => [
            ['n' => '1', 'title' => 'Get Skyrim VR ready', 'body' => 'SKSE VR and the VR Address Library for SKSEVR, like any SKSE mod. Engine Fixes VR and VRIK if you want this to be good rather than merely working. The launcher checks your setup for the traps we know.'],
            ['n' => '2', 'title' => 'Open the launcher', 'body' => 'It finds Skyrim VR in your Steam libraries and the mod manager you use: Mod Organizer 2 (FUS and other lists), Vortex, or none at all.'],
            ['n' => '3', 'title' => 'Install', 'body' => 'One click puts the mod in place, adds it to your Mod Organizer profile, and names anything in your setup that would stop it, with the fix.'],
            ['n' => '4', 'title' => 'Play together', 'body' => 'Play starts the game the way your setup starts it. Host a game and give your friends a six-letter code, or join theirs. Load a save and you are in a party.'],
        ],
        'cta' => 'The full install guide',
    ],

    'devlog' => [
        'label' => 'From the workbench',
        'title' => 'What broke this week, and what it turned out to be',
        'cta'   => 'Every entry',
        'empty' => 'The first entries are being written.',
    ],

    'cta' => [
        'title' => 'Skyrim is a big country to cross alone',
        'body'  => 'Free, open source, and it runs on the modlist you already have.',
        'primary' => 'Download the launcher',
        'secondary' => 'Read the install guide',
    ],
];
