<?php

return [

    'meta' => [
        'title'       => 'Skyrim Together VR — roadmap and known issues',
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
                'body'  => 'If you killed it, it is dead for them too; if they looted it, the chest is empty for you. The long tail is cell boundaries — crossing them fast is where the strangest reports come from.',
            ],
            [
                'n' => 3,
                'state' => 'next',
                'title' => 'VRIK interactions, seen by everyone',
                'body'  => 'VR has gestures a flat game never had: reaching over your shoulder, holstering at your hip, grabbing something out of the air. Those are what makes a body read as a person, and they need to cross the wire as themselves rather than as the nearest matching animation.',
            ],
            [
                'n' => 4,
                'state' => 'next',
                'title' => 'Bodies that stay where you put them',
                'body'  => 'Dragging a corpse first, then handling another player\'s body and living NPCs. A body dragged into a doorway in one headset and left in the open in the other is the kind of thing you only notice at the worst moment.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Nobody under the floor',
                'body'  => 'NPCs occasionally arrive below the ground they should be standing on. They are in sync — just in sync at the wrong height.',
            ],
            [
                'n' => 6,
                'state' => 'later',
                'title' => 'Hits land where the weapon is',
                'body'  => 'A swing in VR is a real swing, not a triggered animation, and the other player\'s game needs to agree about where the steel actually went. Swords already have weight; the hit detection has to earn it.',
            ],
        ],
    ],

    'issues' => [
        'label' => 'Today',
        'title' => 'Known issues',
        'lede'  => 'Current, specific, and not a formality. If you hit something that is not here, it is genuinely new — send the log.',
        'items' => [
            [
                'title' => 'It still crashes',
                'body'  => 'Less than it did, and the remaining ones are mostly around a lot of actors being torn down at once. <code>collect-logs.bat</code> gives us the dump, and the dump names the function.',
            ],
            [
                'title' => 'Crossing cells fast is where things go odd',
                'body'  => 'A bandit launched into the sky, a dead body in the wrong place, a spriggan whose hits never land — all reported while sprinting across country, which is the common thread currently being pulled.',
            ],
            [
                'title' => 'NPCs below floor level',
                'body'  => 'Synced correctly, standing in the wrong place. Mostly cosmetic, occasionally fatal to a fight.',
            ],
            [
                'title' => 'Dead bodies disagree',
                'body'  => 'Dragging works better than it did. Two players handling the same body, or a body handled far away, still does not always end up in the same place in both worlds.',
            ],
            [
                'title' => 'Companions can fall far behind',
                'body'  => 'Travel quickly and your follower may be several cells back. The client is relinquishing actors in cells the game unloaded, which is correct behaviour producing an incorrect-looking result.',
            ],
        ],
        'report' => [
            'title' => 'If you find a new one',
            'body'  => 'Run <code>collect-logs.bat</code> in the launcher folder. It leaves a zip on your Desktop with the client log, any crash dump and both build versions. That zip is the difference between a fix this week and a theory this month.',
            'cta'   => 'Open an issue',
        ],
    ],

    'done' => [
        'label' => 'Behind us',
        'title' => 'Recently off the list',
        'lede'  => 'Not a changelog — the devlog is the changelog. Just the shape of the last few weeks.',
        'items' => [
            'Dropped items follow the hand that threw them, and reach the floor instead of hovering.',
            'Hips cross the wire, so a body bends where its owner bends.',
            'A remote copy that goes out of range and comes back comes back correct.',
            'Swords have weight.',
            'An enemy health meter stops writing to a menu that has already closed.',
            'Unattended bot testing, so a regression is found by a machine overnight rather than by a friend on a Friday.',
        ],
    ],

    'cta' => [
        'title'   => 'Read how it actually went',
        'body'    => 'The devlog has the wrong turns in it too.',
        'primary' => 'Open the devlog',
    ],
];
