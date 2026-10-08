<?php

return [

    'meta' => [
        'title'       => 'Skyrim VR multiplayer FAQ · urSovngarde',
        'description' => 'Skyrim VR co-op, answered: does it work with my modlist? Does it cost anything? Will it get me banned? Can I play with someone on Special Edition?',
    ],

    'hero' => [
        'kicker' => 'The ones that come up every week',
        'title'  => 'Questions',
        'lede'   => 'Short answers. Where a short answer would be a lie, a longer one.',
    ],

    'groups' => [

        [
            'title' => 'The basics',
            'items' => [
                [
                    'q' => 'What is this, in one sentence?',
                    'a' => 'A free, open-source mod that lets you play Skyrim VR with friends on a server one of you runs.',
                ],
                [
                    'q' => 'Is there a multiplayer mod for Skyrim VR?',
                    'a' => 'Yes, this one. urSovngarde, formerly Skyrim Together VR, ports Skyrim Together Reborn\'s co-op to Skyrim VR: you and your friends play in one world, with quests, weather and time of day shared, and each of you sees the others at their real height, with their real hands.',
                ],
                [
                    'q' => 'Does it cost anything?',
                    'a' => 'No, and it cannot. It is licensed GPLv3, inherited from Skyrim Together Reborn, which means the source stays public and anyone can build it themselves. You need your own copy of Skyrim VR; that is all.',
                ],
                [
                    'q' => 'Is this the same as Skyrim Together Reborn?',
                    'a' => 'It is that mod, ported. Reborn is for Skyrim Special Edition, a different executable with different memory addresses and no VR anything. Every engine hook had to be found again for the VR build, and the parts that are about hands and headsets did not exist at all. The multiplayer underneath is Tilted Phoques\' work and the credit is theirs.',
                ],
                [
                    'q' => 'Can I play with someone on Special Edition?',
                    'a' => 'No. Different executable, different build, different world layout. Both of you need Skyrim VR.',
                ],
                [
                    'q' => 'How many people can play?',
                    'a' => 'It is built and tested around small groups: two to four friends. There is no technical lobby cap, but nobody has taken it to a crowd, and the honest answer is that a crowd would find the rough edges faster than you want.',
                ],
            ],
        ],

        [
            'title' => 'Mods and compatibility',
            'items' => [
                [
                    'q' => 'Will it work with my modlist?',
                    'a' => 'Probably, and that is the point. It loads alongside whatever you already run, through MO2, Vortex or a Wabbajack list. The only hard requirement is that <code>uGridsToLoad</code> stays at 5.',
                ],
                [
                    'q' => 'Do both of us need the same mods?',
                    'a' => 'Not byte for byte. Mod checking is deliberately off. But the closer the two lists are, the fewer surprises. Anything that changes what exists in the world or what a creature is will eventually produce "he sees a bear, I see a wolf".',
                ],
                [
                    'q' => 'Do I need VRIK?',
                    'a' => 'Technically no. In practice yes. VRIK is what gives you a body, and your body is what your friend sees. Without it you are still there, just much less of you.',
                ],
                [
                    'q' => 'Does it work with Wabbajack lists like FUS?',
                    'a' => 'Yes. FUS is what it is developed against day to day. Install the mod folder like any other mod and add the launcher as an executable.',
                ],
                [
                    'q' => 'Does it work on Quest?',
                    'a' => 'Only through PC VR: Virtual Desktop, Air Link, a cable. This is a PC mod for the PC game; a standalone headset has no Skyrim VR to mod.',
                ],
            ],
        ],

        [
            'title' => 'Safety and sanity',
            'items' => [
                [
                    'q' => 'Can this get me banned?',
                    'a' => 'There is nothing to be banned from. Skyrim VR has no anti-cheat and no online component, and the game never talks to a server of ours. The urSovngarde launcher does only to look up an invite code or, if you agree, to send a crash report. Your saves are yours, on your disk.',
                ],
                [
                    'q' => 'Why does the launcher replace the game executable?',
                    'a' => 'Because that is how it gets inside a game whose code is encrypted on disk. It is also exactly the shape of a thing you should be wary of, so: the source is public, the licence keeps it public, and the release is built by a script in that same repository. Compiling it yourself is a supported answer.',
                ],
                [
                    'q' => 'Will it corrupt my save?',
                    'a' => 'It has not, and it is not designed to write anything permanent into one. Back your saves up anyway. You are running an alpha of a VR port of a multiplayer mod; a backup costs you nothing and the alternative costs you a playthrough.',
                ],
                [
                    'q' => 'Is my IP address exposed?',
                    'a' => 'To whoever runs the server and whoever is on it, yes, the same as any game where a friend hosts. If that matters to you, use a virtual LAN like Tailscale or ZeroTier instead of forwarding a port; nothing is then reachable from the open internet.',
                ],
            ],
        ],

        [
            'title' => 'The state of it',
            'items' => [
                [
                    'q' => 'Is it finished?',
                    'a' => 'No. It is playable, which is a different and much more recent thing. It crashes, NPCs sometimes end up under the floor, and bodies do not always agree with each other between headsets. The roadmap names the six things being fixed, in order.',
                ],
                [
                    'q' => 'Something broke. What do you need from me?',
                    'a' => 'After a crash the launcher asks whether to send a report, with your names and addresses taken out first; that is all we need. Without the launcher, run <code>collect-logs.bat</code> in the mod\'s launcher folder and send the zip it leaves on your Desktop. A dump names the exact function; a description names a feeling.',
                ],
                [
                    'q' => 'Will there be a Nexus page?',
                    'a' => 'Yes, once the crash list is short enough that a first-time visitor has a good evening rather than an interesting one.',
                ],
                [
                    'q' => 'Can I help?',
                    'a' => 'Yes. Playing it and reporting precisely is worth more than it sounds. Most of what has been fixed was found in somebody\'s log. If you reverse-engineer, there is a short list of engine addresses still unmapped for VR, and the repository explains how they were found.',
                ],
            ],
        ],
    ],

    'cta' => [
        'title'   => 'Not answered here?',
        'body'    => 'Open an issue, or come and ask.',
        'primary' => 'Ask on GitHub',
    ],
];
