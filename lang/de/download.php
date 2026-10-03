<?php

return [

    'meta' => [
        'title'       => 'Skyrim Together VR herunterladen',
        'description' => 'Hol dir die neueste Build von Skyrim Together VR: das komplette Paket für die Erstinstallation oder das kleine Update-Zip, wenn du es schon hast.',
    ],

    'hero' => [
        'kicker' => 'Kostenlos · GPLv3 · ohne Konto',
        'title'  => 'Nimm die Build',
        'lede'   => 'Zwei Dateien. Die große beim ersten Mal, die kleine jedes Mal danach.',
    ],

    'release' => [
        'label'          => 'Die Build',
        'live_label'     => 'Neueste Veröffentlichung',
        'current'        => 'Die aktuelle Build',
        'published'      => 'Veröffentlicht am :date',
        'unknown_date'   => 'Frisch geschnitten',
        'downloads'      => ':count Downloads',
        'notes'          => 'Änderungsnotizen',
        'notes_on_github'=> 'Vollständige Notizen auf GitHub',
        'mirror'         => 'Alle Veröffentlichungen',
    ],

    'state' => [
        'fallback_title' => 'Von GitHub ausgeliefert',
        'fallback_body'  => 'Die neueste Build liegt immer auf der Releases-Seite. Dieses Feld füllt sich mit Version, Datum und Größe, sobald eine Veröffentlichung getaggt ist.',
        'none_title'     => 'Die erste öffentliche Build wird gerade gepackt',
        'none_body'      => 'Hier gibt es noch nichts herunterzuladen. Der Quellcode ist in der Zwischenzeit öffentlich, und im Entwicklertagebuch taucht die Arbeit zuerst auf.',
    ],

    'assets' => [
        'full' => [
            'title' => 'Komplettpaket',
            'body'  => 'Alles: der Mod-Ordner, der Launcher, der Server und die vier Installationsanleitungen. Das ist das, was du beim ersten Mal willst.',
            'meta'  => 'Erstinstallation',
        ],
        'patch' => [
            'title' => 'Nur Update',
            'body'  => 'Nur die ausführbare Client-Datei und ihre Symbole. Zieh es auf update.bat in deinem Launcher-Ordner, fertig. Klein genug, um es im Chat zu verschicken.',
            'meta'  => 'Schon installiert',
        ],
        'server' => [
            'title' => 'Server',
            'body'  => 'Der dedizierte Server allein, für eine Maschine ohne das Spiel. Eine Linux-Build gibt es auch. Frag danach.',
            'meta'  => 'Nur für Hosts',
        ],
        'download_cta' => 'Herunterladen',
        'size'         => 'Größe',
    ],

    'requires' => [
        'label' => 'Voraussetzungen',
        'title' => 'Bevor du klickst',
        'lede'  => 'Nichts davon ist optional, außer wo es dasteht.',
        'items' => [
            ['name' => 'Skyrim VR :version',             'note' => 'Die Steam-Version. Nicht Special Edition, nicht Anniversary: die VR-Programmdatei.', 'state' => 'required'],
            ['name' => 'SKSE VR',                        'note' => 'Die VR-Fassung des Script Extenders. Nach Data, wie jede SKSE-Mod.',                  'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR',  'note' => 'Erst damit findet die Mod überhaupt irgendetwas im Spiel.',                           'state' => 'required'],
            ['name' => 'uGridsToLoad = 5',               'note' => 'Der Standardwert. Der Server lehnt alles andere ab, weil die Welten sonst nicht mehr zusammenpassen.', 'state' => 'required'],
            ['name' => 'Engine Fixes VR',                'note' => 'Beseitigt eine Sorte Absturz, die nichts mit uns zu tun hat.',                        'state' => 'recommended'],
            ['name' => 'VRIK',                           'note' => 'Der Körper, den dein Freund sieht. Dringend empfohlen. Darum geht es im Kern.',      'state' => 'recommended'],
            ['name' => 'Dieselbe Build wie deine Freunde','note' => 'Der Server lehnt Abweichungen ab und nennt dabei beide Versionen.',                   'state' => 'required'],
        ],
    ],

    'next' => [
        'label' => 'Danach',
        'title' => 'Heruntergeladen. Und jetzt',
        'install' => ['title' => 'Installieren',     'body' => 'MO2, Vortex, eine Wabbajack-Liste oder gar kein Manager. Die Anleitung deckt alle vier ab.', 'cta' => 'Zur Anleitung'],
        'host'    => ['title' => 'Hosten',           'body' => 'Eine ausführbare Datei, ein UDP-Port, oder ein virtuelles LAN und gar kein Router.',        'cta' => 'Host-Anleitung'],
        'issues'  => ['title' => 'Wenn es kaputtgeht','body' => 'collect-logs.bat ausführen und das Zip schicken. Darin sind Log, Dump und die Versionen.',   'cta' => 'Fehler melden'],
    ],

    'safety' => [
        'label' => 'Vertrauen',
        'title' => 'Ein Wort zum Vertrauen',
        'body'  => 'Der Launcher ersetzt die Programmdatei des Spiels im Speicher, um seine Arbeit zu tun, also genau die Form von Sache, der man misstrauen sollte. Deshalb: jede Zeile davon liegt auf GitHub, die Lizenz sorgt dafür, dass das so bleibt, und die Build, die du herunterlädst, wird von einem Skript aus demselben Repository gebaut. Wenn du sie lieber selbst kompilierst, ist das eine unterstützte Antwort.',
        'cta'   => 'Quellcode lesen',
    ],
];
