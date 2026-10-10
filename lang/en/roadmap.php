<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: roadmap and known issues',
        'description' => 'The six things being fixed, in the order they are worth fixing, and an honest list of what breaks today.',
    ],

    'hero' => [
        'kicker' => 'Six goals · in order',
        'title'  => 'What is next, and what is broken',
        'lede'   => 'This is the real list, in the real order. Nothing on it is marked done because it was written down; things come off it when the people playing stop reporting them.',
    ],

    'constellation' => [
        'label' => 'The road ahead',
        'title' => 'The six',
        'lede'  => 'Ordered by what is worth fixing first, not by what is easiest. Everything else gets measured against these.',
        'legend' => [
            'active' => 'In hand',
            'next'   => 'Next',
            'later'  => 'After that',
        ],
        'goals' => [
            [
                'n' => 1,
                'state' => 'active',
                'title' => 'No more crashes',
                'body'  => 'Everything else is decoration if the session ends at twenty minutes. Most of the work this month has gone here: null checks through every hook, teardown paths that no longer hand a deleted actor to code still holding it, and a crash-dump tool that names the function instead of inviting a guess.',
            ],
            [
                'n' => 2,
                'state' => 'active',
                'title' => 'The world, identical in both headsets',
                'body'  => 'If you killed it, it is dead for them too; if they looted it, the chest is empty for you. The long tail is cell boundaries. Crossing them fast is where the strangest reports come from.',
            ],
            [
                'n' => 3,
                'state' => 'next',
                'title' => 'VRIK interactions, seen by everyone',
                'body'  => 'VR has gestures a flat game never had: reaching over your shoulder, holstering at your hip, grabbing something out of the air. Those are what makes a body read as a person, and they need to cross the wire as themselves rather than as the nearest matching animation.',
            ],
            [
                'n' => 4,
                'state' => 'active',
                'title' => 'Bodies that stay where you put them',
                'body'  => 'Dragging a corpse works, and both players see it. A corpse now lies in the same place in both worlds. Still to do: another player\'s body, and living NPCs.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Nobody under the floor',
                'body'  => 'NPCs occasionally arrive below the ground they should be standing on. They are in sync, just in sync at the wrong height.',
            ],
            [
                'n' => 6,
                'state' => 'active',
                'title' => 'Hits land where the weapon is',
                'body'  => 'Blades that meet are felt, heard and seen by both players, and the defender\'s screen decides whether a hit was parried. From the next release, only a weapon or a shield parries. Next: blades that physically stop each other.',
            ],
        ],
    ],

    'issues' => [
        'label' => 'Today',
        'title' => 'Known issues',
        'lede'  => 'Current, specific, and not a formality. If you hit something that is not here, it is genuinely new. Send the log.',
        'items' => [
            [
                'title' => 'It still crashes',
                'body'  => 'Less than it did, and the remaining ones are mostly around a lot of actors being torn down at once. The launcher\'s crash report gives us the dump, and the dump names the function.',
            ],
            [
                'title' => 'Crossing cells fast is where things go odd',
                'body'  => 'A bandit launched into the sky, a dead body in the wrong place, a spriggan whose hits never land, all reported while sprinting across country, which is the common thread currently being pulled.',
            ],
            [
                'title' => 'NPCs below floor level',
                'body'  => 'Synced correctly, standing in the wrong place. Mostly cosmetic, occasionally fatal to a fight.',
            ],
            [
                'title' => 'Moved bodies can still disagree',
                'body'  => 'A corpse now lies in the same place in both worlds, and dragging one is seen by both players. Another player\'s body, and living NPCs being moved, can still end up in different places.',
            ],
            [
                'title' => 'PvP is young',
                'body'  => 'Parrying is new. Three ways a hit got through a parry were found on 8 and 9 October, and all three are fixed for the next release. In one game, the other player\'s copy sometimes holds no weapon, and then it cannot be parried.',
            ],
            [
                'title' => 'Hosting through the relay is new',
                'body'  => 'Live since :relay_since, and not yet proven over a full session. If a friend cannot connect, forward the port or use Tailscale, as on the hosting page.',
            ],
            [
                'title' => 'Vortex older than :vortex_min',
                'body'  => 'The launcher copies the files into Data, as before, and they do not show in Vortex\'s mod list. Updating Vortex fixes it.',
            ],
            [
                'title' => 'Companions can fall far behind',
                'body'  => 'Travel quickly and your follower may be several cells back. The client is relinquishing actors in cells the game unloaded, which is correct behaviour producing an incorrect-looking result.',
            ],
        ],
        'report' => [
            'title' => 'If you find a new one',
            'body'  => 'Say yes when the launcher offers to send a crash report. Without the launcher, run <code>collect-logs.bat</code> in the mod\'s launcher folder: it leaves a zip on your Desktop with the client log, any crash dump and both build versions. That report is the difference between a fix this week and a theory this month.',
            'cta'   => 'Open an issue',
        ],
    ],

    'done' => [
        'label' => 'Behind us',
        'title' => 'Recently off the list',
        'lede'  => 'Not a changelog. The devlog is the changelog. Just the shape of the last few weeks.',
        'items' => [
            'A launcher: install, check, play, host and join with a code.',
            'Hosting without opening a port, through a relay of ours.',
            'Blades that meet are felt, heard and seen by both players.',
            'A follower belongs to the game of the player she follows.',
            'A corpse lies in the same place in both worlds.',
            'Crash dumps small enough to send.',
            'Unattended bot testing, so a regression is found by a machine overnight rather than by a friend on a Friday.',
        ],
    ],

    'cta' => [
        'title'   => 'Read how it actually went',
        'body'    => 'The devlog has the wrong turns in it too.',
        'primary' => 'Open the devlog',
    ],
];
