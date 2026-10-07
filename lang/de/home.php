<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: du bist nicht mehr das einzige Drachenblut',
        'description' => 'Kostenloser, quelloffener Koop für Skyrim VR. Deine Modliste, dein Spielstand, dein Server, und jemand, der wirklich neben dir steht, in seiner echten Größe, mit seinen echten Händen.',
    ],

    'hero' => [
        'kicker'   => 'Quelloffen · GPLv3 · VR-Portierung von Skyrim Together Reborn',
        'title'    => 'Du bist nicht mehr das einzige Drachenblut',
        'lede'     => 'Koop für Skyrim VR. Deine Modliste, dein Spielstand, dein Server, und jemand, der wirklich mit dir im Raum steht, in seiner eigenen Größe, mit seinen eigenen Händen.',
        'primary'  => 'Launcher herunterladen',
        'secondary'=> 'So wird es installiert',
        'scroll'   => 'Weiterlesen',
        'caption'  => 'Zwei auf dem Grat. Einer davon ist kein NPC.',
    ],

    'stats' => [
        'version_label'  => 'Aktuelle Build',
        'version_none'   => 'Wird gepackt',
        'version_rolling'=> 'Neueste Build',
        'port_label'     => 'Dein Server, dein Port',
        'port_note'      => 'UDP, weitergeleitet oder über VPN',
        'game_label'     => 'Läuft auf',
        'game_value'     => 'Skyrim VR :version',
        'game_note'      => 'SKSE VR und die VR Address Library',
        'price_label'    => 'Preis',
        'price_value'    => 'Kostenlos, für immer',
        'price_note'     => 'GPLv3, Quellcode offen',
    ],

    'plain' => [
        'label' => 'Klartext',
        'title' => 'Was das hier wirklich ist',
        'body'  => 'Skyrim Together Reborn hat Koop in Skyrim Special Edition gebracht. Skyrim VR ist eine andere ausführbare Datei: andere Speicheradressen, andere Engine-Klassen, ein Körper dort, wo vorher nur eine Kamera war. Das hier ist dieselbe Mod, auseinandergenommen und für die VR-Build wieder zusammengesetzt, von zwei Fullstack-Entwicklern, die unterwegs C++ und Reverse Engineering gelernt haben, was je nach Temperament beruhigend oder beunruhigend klingt.',
        'body2' => 'Es ist kostenlos, der Quellcode ist öffentlich, und nichts läuft jemals über einen Server, der uns gehört. Du hostest, oder dein Freund hostet. Niemand legt irgendwo ein Konto an.',
    ],

    'features' => [
        'label'  => 'Was es kann',
        'title'  => 'Alles hier steckt in der Build, die du herunterladen kannst',
        'lede'   => 'Nichts davon ist ein Versprechen: es ist alles in der heutigen Build. Was noch fehlt, steht beim Namen genannt im Fahrplan.',

        'items' => [
            [
                'rune'  => 'ᛗ',
                'title' => 'Er ist wirklich da',
                'body'  => 'Kopf, Hände und Hüfte gehen über die Leitung. Mit VRIK hat dein Freund einen Körper. Wenn er sich also um eine Ecke lehnt, siehst du ihn sich lehnen. Zeigt er auf etwas, kannst du dem Arm folgen. Kein schwebender Helm. Eine Person.',
            ],
            [
                'rune'  => 'ᛟ',
                'title' => 'Ein Menü, das in VR gehört',
                'body'  => 'Die Mod bekommt einen eigenen Tab im SteamVR-Dashboard: Laserpointer, SteamVR-Tastatur, in bequemem Abstand lesbar. F6 verbindet und trennt, ohne das Headset abzusetzen.',
            ],
            [
                'rune'  => 'ᚦ',
                'title' => 'Deine Modliste, unangetastet',
                'body'  => 'Mod Organizer 2, Vortex, eine Wabbajack-Liste wie FUS oder gar kein Manager. Deine Ladereihenfolge bleibt deine Ladereihenfolge. Der Launcher startet das Spiel und lädt SKSE für dich. Den SKSE-Loader fasst du nie wieder an.',
            ],
            [
                'rune'  => 'ᛒ',
                'title' => 'Eine Welt, nicht zwei',
                'body'  => 'Quests, Wetter und Tageszeit werden über die Gruppe geteilt, und die Gruppe bildet sich von selbst, sobald ihr beide verbunden seid. Ein fallen gelassener Gegenstand landet in beiden Headsets auf demselben Boden, und folgt unterwegs der Hand, die ihn geworfen hat.',
            ],
            [
                'rune'  => 'ᚾ',
                'title' => 'Dein Server, deine Regeln',
                'body'  => 'Eine ausführbare Datei und ein UDP-Port. Leite ihn weiter, oder setz alle auf Tailscale, ZeroTier oder Radmin und lass den Router ganz weg. Passwort, PvP, was der Tod kostet: deine Entscheidung. Keine Lobby, kein Matchmaking, kein Konto.',
            ],
            [
                'rune'  => 'ᛉ',
                'title' => 'Es verbindet sich von selbst neu',
                'body'  => 'Eine abgerissene Verbindung versucht es nach 5 Sekunden erneut, dann nach 10, 20, 30 und 60, und sagt es dir auf dem Bildschirm. Eine abgelehnte versucht es nicht und sagt warum: falsche Build, falsches Passwort. Statt dich vor einer Ladetür stehen zu lassen.',
            ],
        ],
    ],

    'honest' => [
        'label' => 'Die andere Hälfte der Wahrheit',
        'title' => 'Und es wird kaputtgehen',
        'body'  => 'Das hier ist eine Mod einer Mod einer Spiel-Engine, geschoben in ein Headset. Es stürzt ab. NPCs fallen gelegentlich durch Böden. Eine Leiche, die in der einen Welt weggezogen wird, bleibt in der anderen manchmal liegen. Wir führen eine Liste bekannter Fehler, die konkret statt entschuldigend ist, ein Tagebuch, das zugibt, wenn eine Diagnose falsch war, und eine Batchdatei, die deine Logs und den Crashdump in ein einziges Zip packt.',
        'cta_roadmap' => 'Was kaputt ist',
        'cta_devlog'  => 'Tagebuch lesen',
    ],

    'tips' => [
        'label' => 'Vom Ladebildschirm',
        'items' => [
            'Der Server weist jeden Client ab, dessen Build nicht passt. Die Verbindungsmeldung nennt beide Versionen. Die Diagnose dauert zehn Sekunden.',
            'uGridsToLoad muss 5 sein. Das ist der Standard jeder Wabbajack-Liste, und der Server akzeptiert nichts anderes.',
            'VRIK gibt deinem Freund einen Körper. Ohne VRIK ist er immer noch da, nur deutlich weniger von ihm.',
            'Der Host verbindet sich mit seinem eigenen Server über 127.0.0.1, dieselbe Adresse wie alle anderen, nur ohne den Weg.',
            'Spielt beide dieselbe Modliste. »Er sieht einen Bären, ich sehe einen Wolf« sind fast immer zwei verschiedene Ladereihenfolgen.',
        ],
    ],

    'steps' => [
        'label' => 'Reinkommen',
        'title' => 'Von nichts bis zum Spielen',
        'lede'  => 'Vier Schritte, und der Launcher erledigt die meisten.',
        'items' => [
            ['n' => '1', 'title' => 'Skyrim VR vorbereiten', 'body' => 'SKSE VR und die VR Address Library for SKSEVR, wie bei jeder SKSE-Mod. Engine Fixes VR und VRIK, wenn es gut werden soll und nicht nur funktionieren. Der Launcher prüft deine Installation auf die Fallen, die wir kennen.'],
            ['n' => '2', 'title' => 'Den Launcher öffnen', 'body' => 'Er findet Skyrim VR in deinen Steam-Bibliotheken und den Mod-Manager, den du nutzt: Mod Organizer 2 (FUS und andere Listen), Vortex oder keinen.'],
            ['n' => '3', 'title' => 'Installieren', 'body' => 'Ein Klick legt die Mod ab, trägt sie in dein Mod-Organizer-Profil ein und nennt, was sie in deiner Installation aufhalten würde, mit der Lösung.'],
            ['n' => '4', 'title' => 'Zusammen spielen', 'body' => 'Spielen startet das Spiel so, wie deine Installation es startet. Hoste ein Spiel und gib deinen Freunden einen sechsstelligen Code, oder tritt ihrem bei. Lade einen Spielstand, und ihr seid in einer Gruppe.'],
        ],
        'cta' => 'Die vollständige Anleitung',
    ],

    'devlog' => [
        'label' => 'Von der Werkbank',
        'title' => 'Was diese Woche kaputtging, und was es wirklich war',
        'cta'   => 'Alle Einträge',
        'empty' => 'Die ersten Einträge entstehen gerade.',
    ],

    'cta' => [
        'title' => 'Himmelsrand ist ein großes Land, um es allein zu durchqueren',
        'body'  => 'Kostenlos, quelloffen, und es läuft auf der Modliste, die du schon hast.',
        'primary' => 'Launcher herunterladen',
        'secondary' => 'Anleitung lesen',
    ],
];
