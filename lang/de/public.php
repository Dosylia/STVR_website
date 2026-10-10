<?php

return [

    'meta' => [
        'title'       => 'Öffentlicher Skyrim VR Server · urSovngarde',
        'description' => 'Ein urSovngarde-Server, auf den jeder kann: wer gerade drauf ist, wo auf der Karte sie sind und wie du beitrittst.',
    ],

    'hero' => [
        'kicker' => 'Offen für alle · kein Einladungscode',
        'title'  => 'Der öffentliche Server',
        'lede'   => 'Ein Server, den wir für alle mit der Mod am Laufen halten. Schau, wer drauf ist, sieh nach, wo sie sind, und spiel mit.',
    ],

    // Shown instead of everything below while the server or its status is not live.
    'closed' => [
        'title' => 'Noch nicht offen',
        'body'  => 'Der öffentliche Server ist noch im Aufbau. Bis er öffnet, spiel mit Freunden: Hoste ein Spiel im Launcher und schick ihnen den Code aus sechs Buchstaben.',
        'cta'   => 'Selbst hosten',
        'sample' => 'Entwicklungsvorschau: Der Server auf dieser Seite ist erfunden.',
    ],

    'status' => [
        'label'    => 'Gerade jetzt',
        'online'   => 'Online',
        'offline'  => 'Offline',
        'offline_body' => 'Der Server antwortet im Moment nicht. Vielleicht startet er gerade für ein Update neu; schau in ein paar Minuten wieder vorbei.',
        'players'  => 'Spieler',
        'of'       => ':count von :max',
        'address'  => 'Adresse',
        'version'  => 'Build',
        'protocol' => 'Nachrichtensatz',
        'password' => 'Passwort',
        'password_yes' => 'Ja, frag auf Discord',
        'password_no'  => 'Keins',
        'up_since' => 'Läuft seit',
        'updated'  => 'Stand von :time',
    ],

    'join' => [
        'label' => 'Beitreten',
        'title' => 'So trittst du bei',
        'steps' => [
            ['title' => 'Eine Build haben, die seine Nachrichten spricht', 'body' => 'Der Server läuft mit Build :version, Nachrichtensatz :protocol. Jede Build mit demselben Nachrichtensatz verbindet sich, also klappt eine nahe Version oft auch. Wirst du abgelehnt, nennt der Launcher beide Versionen, und auf der Download-Seite gibt es die richtige.'],
            ['title' => 'Die Adresse eintragen',    'body' => 'Öffne im Launcher Beitreten, wähle "oder eine Adresse" und füge die Adresse von oben ein. Ohne Launcher kommt sie in die erste Zeile deiner connect.txt.'],
            ['title' => 'Einen beliebigen Spielstand laden', 'body' => 'Das Spiel tritt dem Server ein paar Sekunden nach dem Laden des Spielstands bei. Dein Charakter und dein Spielstand bleiben deine.'],
        ],
        'copy' => 'Adresse kopieren',
        'button' => 'Mit dem Launcher beitreten',
        'button_note' => 'Der Launcher fragt, bevor er beitritt. Passiert nichts, aktualisiere den Launcher: Ältere Versionen kennen diesen Link nicht.',
    ],

    'who' => [
        'label' => 'Auf dem Server',
        'title' => 'Wer da ist',
        'none'  => 'Gerade ist niemand online. Sei der Erste.',
        'inside' => 'In einem Innenraum',
        'note'  => 'Charakternamen, so wie die Spieler sie im Spiel festgelegt haben, und Orte in der Spielsprache des jeweiligen Spielers. Wer in einem Innenraum ist, steht in der Liste, aber ohne Punkt auf der Karte.',
        'hidden' => '{1} Dazu ein weiterer Spieler, der nicht aufgeführt ist.|[2,*] Dazu :count weitere Spieler, die nicht aufgeführt sind.',
        'hide' => 'Du willst hier nicht erscheinen? Im Launcher: „Mich auf der Seite des öffentlichen Servers verbergen“.',
    ],

    'map' => [
        'label'  => 'Wo sie sind',
        'title'  => 'Die Karte',
        'note'   => 'Alle :seconds Sekunden aktualisiert, solange du zusiehst. Unsere eigenen Zeichnungen, genau genug für "in der Nähe von Flusswald".',
        'switch' => 'Karte wählen',
        'title_solstheim' => 'Karte von Solstheim mit den Spielern auf dem öffentlichen Server',
        'title_soul_cairn' => 'Karte des Seelengrabs mit den Spielern auf dem öffentlichen Server',
        'red_mountain' => 'Roter Berg',
        // The areas a player can be outdoors in (config stvr.public_server.areas). Skyrim and Solstheim have a map.
        'areas'  => [
            'skyrim'         => 'Himmelsrand',
            'solstheim'      => 'Solstheim',
            'blackreach'     => 'Schwarzweite',
            'sovngarde'      => 'Sovngarde',
            'skuldafn'       => 'Skuldafn',
            'soul_cairn'     => 'Seelengrab',
            'forgotten_vale' => 'Vergessenes Tal',
            'apocrypha'      => 'Apokryphen',
            'deepwood_vale'  => 'Deepwood Vale',
        ],
        'solstheim' => [
            'raven_rock'    => 'Rabenfels',
            'skaal_village' => 'Skaal Village',
            'thirsk'        => 'Thirsk Mead Hall',
            'tel_mithryn'   => 'Tel Mithryn',
            'karstaag'      => 'Castle Karstaag',
            'miraak'        => 'Temple of Miraak',
            'frostmoth'     => 'Fort Frostmoth',
            'kolbjorn'      => 'Kolbjorn Barrow',
        ],
        'soul_cairn' => [
            'arrival'  => 'Hier kommst du an',
            'boneyard' => 'The Boneyard',
            'reaper'   => 'Schnitterhöhle',
        ],
        'sea'    => 'Geistermeer',
        'throat' => 'Hals der Welt',
        'towns'  => [
            'solitude'   => 'Einsamkeit',
            'morthal'    => 'Morthal',
            'dawnstar'   => 'Dämmerstern',
            'winterhold' => 'Winterfeste',
            'windhelm'   => 'Windhelm',
            'whiterun'   => 'Weißlauf',
            'markarth'   => 'Markarth',
            'falkreath'  => 'Falkenring',
            'riften'     => 'Rifton',
            'riverwood'  => 'Flusswald',
            'helgen'     => 'Helgen',
            'ivarstead'  => 'Ivarstedt',
            'fort_dawnguard'  => 'Festung Dämmerwacht',
            'castle_volkihar' => 'Burg Volkihar',
        ],
        'title_svg' => 'Karte von Himmelsrand mit den Spielern auf dem öffentlichen Server',
    ],

    'rules' => [
        'label' => 'Hausregeln',
        'title' => 'Seid nett zueinander',
        'items' => [
            'Es ist eine geteilte Welt, und eine frühe: Dinge werden aus dem Takt geraten. Sag auf Discord Bescheid, wenn es passiert.',
            'Kein Griefing, keine Belästigung.',
            'Einen Absturz meldest du über den Launcher. Eine Person meldest du auf unserem Discord.',
        ],
    ],

    'cta' => [
        'title'   => 'Lieber mit deiner eigenen Gruppe spielen?',
        'body'    => 'Hoste ein Spiel im Launcher, schick einen Code aus sechs Buchstaben, und die Welt gehört euch.',
        'primary' => 'Server hosten',
        'secondary' => 'Launcher herunterladen',
    ],
];
