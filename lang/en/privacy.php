<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: privacy',
        'description' => 'What a crash report holds and how it is deleted after :days days, what invite codes and the relay keep, and the two cookies this site sets.',
    ],

    'hero' => [
        'kicker' => 'Crash reports, hosting and your data',
        'title'  => 'Privacy',
        'lede'   => 'What a crash report holds, what hosting through us keeps, what this site sets, and for how long.',
    ],

    'discord' => 'our Discord server',

    'sections' => [

        [
            'title' => 'Nothing leaves without a yes',
            'body'  => [
                'When the game closes after a crash, the launcher asks whether to send a report about it. You can answer for this crash only, yes or no, or once for all of them: always or never. Always and never can be changed later in the launcher\'s settings.',
                'If the game closed while you were in the headset, the question waits until you next open the launcher. Closing the window without answering sends nothing.',
            ],
        ],

        [
            'title' => 'What a report holds',
            'body'  => ['Only files about the crash, and only from the last day:'],
            'items' => [
                'The mod\'s own log: what it connected to, what it kept in step between the games, and the errors it met.',
                'Crash Logger\'s report of each crash: where in the game\'s code it happened, your list of plugins and SKSE plugins, your version of Windows and the parts of your PC (processor, graphics card, memory, headset model).',
                'The server\'s log, if you were the one hosting.',
                'The version of the mod you were running.',
                'A small crash dump of a few megabytes: what the game\'s threads were doing at the moment of the crash. It can hold small fragments of whatever the game had in memory just then.',
                'Your answer to one question: did it crash while you were playing?',
            ],
        ],

        [
            'title' => 'What is taken out first',
            'body'  => ['On your PC, before anything is sent, in every file including the crash dump:'],
            'items' => [
                'Your Windows user name, wherever it appears in a file path.',
                'Every IP address and server address.',
                'Your Discord id.',
                'Player and character names, replaced by "Player A", "Player B" and so on.',
            ],
        ],

        [
            'title' => 'What never leaves your PC',
            'items' => [
                'Your saves.',
                'Screenshots, and images of any kind.',
                'Full crash dumps. They run to hundreds of megabytes and hold far more of the game\'s memory than a report needs.',
                'Your mods, your settings files and the files of your modlist.',
                'Anything not named on this page.',
            ],
        ],

        [
            'title' => 'Why we ask',
            'body'  => [
                'A crash on another PC, with another modlist, is invisible from here unless someone sends it. Most of what has been fixed so far was found in somebody\'s log.',
                'Reports are sorted by a program on our side that groups identical crashes and ranks them by how often they happen and how many people they hit. It reads logs; it decides nothing about you. Reports are used for that and nothing else: no advertising, no tracking, nothing sold or shared.',
            ],
        ],

        [
            'title' => 'Where it goes and who reads it',
            'body'  => [
                'A report travels encrypted (HTTPS) to a small service of ours that runs on Cloudflare, and is kept there. Only the people who work on the mod can read it: two people today.',
                'Like every web server, that service sees the address a report comes from. It keeps a scrambled form of the address (a one-way hash) for one hour, to count reports and stop floods, and never stores the address with the report.',
                'When a report arrives, a short line is posted in a private channel of :discord: its number, its size, the mod\'s version, whether it crashed during play, and which crash it is: its name if we already know it, or the place in the game\'s code where it happened. Never the logs themselves.',
            ],
        ],

        [
            'title' => 'How long it is kept',
            'body'  => [
                'Every report is deleted automatically :days days after it arrives, on the service and on the PC where reports are read.',
            ],
        ],

        [
            'title' => 'Deleting a report',
            'body'  => [
                'After sending, the launcher shows the report\'s number and keeps a list of the numbers it has sent. Give a number on :discord and that report is deleted everywhere, no questions asked.',
                'Choose "never" in the launcher and nothing is sent from then on.',
            ],
        ],

        [
            'title' => 'Invite codes',
            'body'  => [
                'When you host with the launcher, our hub (the same Cloudflare service that receives reports) keeps your public address and port, whether the server has a password (never the password itself), the launcher\'s version and, when there is one, the relay session. It keeps them for :invite_hours hours; the launcher renews them every hour while you host and removes them when you stop.',
                'Anyone with the code gets the address. While you host, your Steam friends see "Hosting urSovngarde", and their launcher can read the code.',
            ],
        ],

        [
            'title' => 'The relay',
            'body'  => [
                'When hosting goes through the relay, the game\'s traffic between you and your friends passes through a server we rent from IONOS, in a data centre in Germany: the same server as this website. The traffic is encrypted by the game\'s own networking, and the relay cannot read it.',
                'The relay keeps no addresses in its logs. Once a minute it writes counts only: sessions, players, packets and bytes. It forgets a session 60 seconds after it goes quiet.',
            ],
        ],

        [
            'title' => 'This website',
            'body'  => [
                'The site sets two cookies, both strictly necessary and both gone after two hours: <code>skyrim-together-vr-session</code>, which the site\'s framework uses to hold a visit together, and <code>XSRF-TOKEN</code>, a security token against forged forms. There is no tracking, no analytics and no advertising, which is why there is no cookie banner.',
                'Like every web server, ours keeps an access log that records the address and time of each request.',
                'When the launcher is downloaded from this site, or an installed launcher asks whether there is an update, the site tells our hub, which adds one to that day\'s count (and, for a download, to that version\'s). Nothing about who downloaded is sent.',
            ],
        ],
    ],
];
