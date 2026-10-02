<?php

return [

    'meta' => [
        'title'       => 'Skyrim Together VR installieren',
        'description' => 'Skyrim Together VR mit Mod Organizer 2, einer Wabbajack-Liste, Vortex oder ganz ohne Mod-Manager installieren. Voraussetzungen, connect.txt, erster Start und Updates.',
    ],

    'hero' => [
        'kicker' => 'Eine Viertelstunde, das meiste davon Download',
        'title'  => 'Das Einbauen',
        'lede'   => 'Such dir aus, wie du Mods verwaltest. Der Rest ist für alle gleich.',
    ],

    'prereq' => [
        'title' => 'Zuerst das, was nicht von uns ist',
        'lede'  => 'Installiere das hier genau wie jede andere SKSE-Mod. Wenn Skyrim VR schon mit SKSE-Mods läuft, ist das meiste davon erledigt.',
        'items' => [
            ['name' => 'Skyrim VR :version',            'note' => 'Die VR-Programmdatei von Steam. Special Edition genügt nicht.',                        'state' => 'required'],
            ['name' => 'SKSE VR',                       'note' => 'Nach Data, neben Skyrim.esm, wie immer.',                                              'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR', 'note' => 'Die Nachschlagetabelle, mit der die Mod irgendetwas im Spiel findet.',                  'state' => 'required'],
            ['name' => 'Engine Fixes VR',               'note' => 'Beseitigt Abstürze, die der Engine gehören und nicht uns.',                             'state' => 'recommended'],
            ['name' => 'VRIK',                          'note' => 'Gibt deiner Figur einen Körper — und genau diesen Körper sieht dein Freund sich bewegen.', 'state' => 'recommended'],
        ],
        'ugrids' => 'Eine Einstellung zählt: <code>uGridsToLoad</code> muss in der <code>SkyrimPrefs.ini</code> auf <code>5</code> stehen. Das ist überall der Standard, auch in jeder Wabbajack-Liste, und der Server lehnt jeden anderen Wert ab — bei unterschiedlich vielen geladenen Zellen wären sich die beiden Welten still und leise nicht mehr einig darüber, was überhaupt existiert.',
    ],

    'methods' => [
        'title' => 'Dann die Mod',
        'lede'  => 'Drei Wege, dasselbe Ziel. Mod Organizer 2 ist der, den die Entwickler benutzen.',

        'mo2' => [
            'label' => 'Mod Organizer 2',
            'note'  => 'Auch für Wabbajack-Listen: FUS, Mad God’s Overhaul, deine eigene.',
            'steps' => [
                ['title' => 'Mod-Ordner installieren',    'body' => 'Zieh den Ordner <code>Skyrim Together mod</code> auf die MO2-Modliste, oder zippe ihn und nutze <em>Install a new mod</em>. Hak ihn an.'],
                ['title' => 'Plugin aktivieren',          'body' => 'Hak <code>SkyrimTogether.esp</code> in der Plugin-Liste rechts an.'],
                ['title' => 'Launcher ablegen',           'body' => 'Kopiere den Ordner <code>Skyrim Together VR</code> in den <code>tools\\</code>-Ordner deiner Liste. Jeder Ort geht; <code>tools\\</code> hält es ordentlich.'],
                ['title' => 'Als Programm eintragen',     'body' => 'In MO2: Zahnrad neben <em>Run</em> → <strong>+</strong> → <em>Add from file</em> → <code>SkyrimTogetherVR.exe</code>. Übernehmen. Ab jetzt startest du das Spiel damit, nicht mehr mit SKSE.'],
            ],
        ],

        'vortex' => [
            'label' => 'Vortex',
            'note'  => 'Funktioniert einwandfrei. MO2 ist nur das, was getestet wurde.',
            'steps' => [
                ['title' => 'SKSE-Mods normal installieren', 'body' => 'SKSE VR, die VR Address Library, Engine Fixes VR und VRIK laufen über Vortex wie jede andere Mod.'],
                ['title' => 'Die Koop-Mod installieren',     'body' => 'Zippe den Ordner <code>Skyrim Together mod</code> (Rechtsklick → Senden an → ZIP-komprimierter Ordner), dann <em>Mods → Install From File</em>, Zip auswählen, aktivieren. <code>SkyrimTogether.esp</code> unter Plugins anhaken. Deployen, wenn Vortex fragt.'],
                ['title' => 'Launcher ablegen',              'body' => 'Leg den Ordner <code>Skyrim Together VR</code> neben <code>SkyrimVR.exe</code>. <strong>Nicht</strong> in <code>Data</code>.'],
                ['title' => 'Von dort starten',              'body' => 'Starte <code>SkyrimTogetherVR.exe</code> direkt, oder trag es über <em>Add Tool</em> im Vortex-Dashboard ein. Starte nie den SKSE-Loader selbst — der Launcher startet das Spiel und lädt SKSE für dich.'],
            ],
            'warnings' => [
                '<strong>Purge</strong> in Vortex entfernt jede deployte Mod aus <code>Data</code>, diese eingeschlossen. Vor dem Spielen erneut deployen.',
                'Vortex braucht Spiel und Staging-Ordner auf demselben Laufwerk, sonst gibt es keine Hardlinks. Das ist eine Vortex-Regel, keine von uns — behebe sie dort, wenn Vortex sich beschwert.',
            ],
        ],

        'manual' => [
            'label' => 'Ohne Mod-Manager',
            'note'  => 'Völlig in Ordnung. Du bist dann eben selbst der Mod-Manager.',
            'steps' => [
                ['title' => 'Mod hineinkopieren',  'body' => 'Alles aus <code>Skyrim Together mod</code> kommt nach <code>Skyrim VR\\Data</code>, neben <code>Skyrim.esm</code>. Aktiviere <code>SkyrimTogether.esp</code> im Mods-Bildschirm des Spiels.'],
                ['title' => 'Launcher ablegen',    'body' => 'Leg den Ordner <code>Skyrim Together VR</code> irgendwohin — im Skyrim-VR-Ordner ist ein vernünftiger Platz.'],
                ['title' => 'Von dort starten',    'body' => 'Starte das Spiel mit <code>SkyrimTogetherVR.exe</code> aus diesem Ordner, nicht mit SKSE. Beim ersten Start fragt es, wo Skyrim VR installiert ist.'],
            ],
        ],
    ],

    'connect' => [
        'title' => 'Einen Server eintragen',
        'lede'  => 'Der Client liest eine kleine Textdatei, um zu wissen, wohin. Du schreibst sie einmal.',
        'easy'  => 'Der einfache Weg: Doppelklick auf <code>setup-connect.bat</code> im Ordner <code>Skyrim Together VR</code> und die Adresse eintippen.',
        'manual'=> 'Von Hand: lege <code>:path</code> an, die Adresse in Zeile eins und das Server-Passwort — falls es eines gibt — in Zeile zwei.',
        'table' => [
            'who'  => 'Wer du bist',
            'line1'=> 'Zeile 1',
            'line2'=> 'Zeile 2',
            'host' => 'Du hostest auf dem PC, auf dem du spielst',
            'host1'=> '127.0.0.1::port',
            'friend'=> 'Du trittst jemandem bei',
            'friend1'=> '<seine Adresse>::port',
            'pass' => 'Das Passwort, falls der Server eines hat',
            'none' => 'Leer lassen',
        ],
        'warning' => 'Nur die Adresse. Kein <code>http://</code>, keine Anführungszeichen, keine Leerzeichen am Ende.',
    ],

    'first' => [
        'title' => 'Die erste Sitzung',
        'steps' => [
            ['title' => 'Jemand startet einen Server', 'body' => 'Der Host führt <code>host-server.bat</code> aus und lässt das Fenster offen. Wenn du das bist: siehe Host-Anleitung.'],
            ['title' => 'Alle starten das Spiel',      'body' => 'Über MO2, über Vortex oder direkt die EXE. Bei einer schweren Modliste: gib ihr Zeit.'],
            ['title' => 'Spielstand laden',            'body' => 'Irgendeinen. Etwa fünf Sekunden später steht da <em>Skyrim Together: connecting…</em> und danach <em>connected (build …)</em>. Die Gruppe bildet sich von selbst; niemand muss jemanden einladen.'],
            ['title' => 'Spielen',                     'body' => 'Das SteamVR-Dashboard hat einen <strong>Skyrim Together</strong>-Tab — System-Taste drücken, Laserpointer benutzen. <code>:key</code> trennt und verbindet wieder, ohne das Spiel zu verlassen.'],
        ],
    ],

    'update' => [
        'label' => 'Aktuell bleiben',
        'title' => 'Aktualisieren',
        'body'  => 'Spiel schließen. Zieh das Update-Zip auf <code>update.bat</code> im Ordner <code>Skyrim Together VR</code>. Es tauscht die Dateien, ohne MO2 zu schließen. Von Hand heißt das: <code>SkyrimTogetherVR.exe</code> und <code>SkyrimTogetherVR.pdb</code> ersetzen.',
        'warn'  => 'Alle müssen auf derselben Build sein, der Server eingeschlossen. Eine Abweichung wird beim Verbinden abgelehnt, und die Meldung nennt beide Versionen — du siehst also, wer hinterherhinkt.',
    ],

    'trouble' => [
        'label' => 'Fehlersuche',
        'title' => 'Wenn es nicht funktioniert',
        'lede'  => 'Grob nach Häufigkeit sortiert.',
        'items' => [
            ['q' => 'Es verbindet sich nie',                 'a' => 'Zuerst <code>connect.txt</code> prüfen: richtige Adresse, richtiger Port, nichts sonst in der Zeile. Dann prüfen, ob das Server-Fenster beim Host wirklich offen ist — es schreibt bei jeder Verbindung eine Zeile.'],
            ['q' => 'Sofort abgelehnt',                      'a' => 'Das ist Absicht. Die Meldung sagt warum: abweichende Build oder falsches Passwort. Builds müssen exakt übereinstimmen, Server eingeschlossen.'],
            ['q' => 'Er sieht einen Bären, ich einen Wolf',   'a' => 'Unterschiedliche Ladereihenfolgen. Bring beide Modlisten so nah aneinander wie möglich — gleiche Liste, gleiche Version, gleiche optionale Mods.'],
            ['q' => 'Das Spiel stürzt ab',                   'a' => 'Führe <code>collect-logs.bat</code> im Launcher-Ordner aus. Es legt ein Zip auf dem Desktop ab, mit Log, Crashdump und Versionen. Schick das: es ist der Unterschied zwischen einer Behebung und einer Vermutung.'],
            ['q' => 'Es startet ohne meine SKSE-Mods',       'a' => 'Du hast den SKSE-Loader statt <code>SkyrimTogetherVR.exe</code> gestartet. Der Launcher lädt SKSE selbst — geh durch ihn, nicht an ihm vorbei.'],
        ],
    ],

    'cta' => [
        'title' => 'Irgendjemand muss den Server betreiben',
        'body'  => 'Es ist eine ausführbare Datei und ein UDP-Port — oder gar kein Port, wenn dir ein virtuelles LAN lieber ist.',
        'primary' => 'Host-Anleitung',
    ],
];
