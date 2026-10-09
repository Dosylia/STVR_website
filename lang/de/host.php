<?php

return [

    'meta' => [
        'title'       => 'Einen Skyrim VR Multiplayer-Server hosten · urSovngarde',
        'description' => 'Hoste einen Skyrim VR Koop-Server mit dem Launcher und einem Code aus sechs Buchstaben, über unser Relay ganz ohne offenen Port, oder von Hand mit Portweiterleitung auf UDP :port oder einem virtuellen LAN.',
    ],

    'hero' => [
        'kicker' => 'Eine Programmdatei · ein UDP-Port · kein Konto',
        'title'  => 'Den Server betreiben',
        'lede'   => 'Der Server ist ein Programm auf einem PC, und er gehört dem, der ihn startet. Kein Konto, keine Lobby, kein Matchmaking.',
    ],

    'launcher' => [
        'label' => 'Der einfache Weg',
        'title' => 'Mit dem Launcher hosten',
        'steps' => [
            ['title' => 'Auf Spiel hosten drücken',            'body' => 'Der Launcher startet den Server, den seine Installation neben die Mod gelegt hat, wartet, bis er wirklich läuft, und zeigt einen Code aus sechs Buchstaben. Vorher kannst du ein Passwort setzen.'],
            ['title' => 'Den Code schicken',                   'body' => 'Deine Freunde tippen ihn in ihrem Launcher unter Beitreten ein, oder sie drücken in ihrer Liste der Steam-Freunde auf Beitreten neben deinem Namen.'],
            ['title' => 'Nichts am Router aufmachen',          'body' => 'Mit Launcher :relay_min oder neuer auf beiden Seiten läuft das Spiel über ein Relay von uns, in Betrieb seit :relay_since. Es ist neu. Kommt ein Freund also nicht rein, nimm einen der beiden Wege unten unter Netzwerk.'],
            ['title' => 'Hosten beenden, wenn ihr fertig seid', 'body' => 'Das nimmt den Code vom Netz und schließt den Server.'],
        ],
    ],

    'start' => [
        'label' => 'Von Hand',
        'title' => 'Ohne den Launcher',
        'steps' => [
            ['title' => 'Den Server-Ordner irgendwo behalten', 'body' => 'Irgendwo auf der Maschine, die hosten soll. Der Server braucht das Spiel nicht. Eine dauerhaft laufende Kiste oder ein alter Laptop tun es auch.'],
            ['title' => 'host-server.bat ausführen',           'body' => 'Es weigert sich, einen zweiten Server zu starten, startet diesen und zeigt die Adresse zum Weitergeben an. Ein Konsolenfenster öffnet sich und nennt den Port.'],
            ['title' => 'Das Fenster offen lassen',            'body' => 'Schließen beendet die Sitzung. Unter Windows 11 öffnet es sich eventuell als Tab in einem bestehenden Terminal. Siehst du jemals zwei Server-Tabs, schließe beide und fang neu an.'],
            ['title' => 'Zuschauen, wer ankommt',              'body' => 'Die Konsole schreibt <em>New player … connected</em>. Das ist der schnellste Weg, um zu wissen, dass eine Verbindung überhaupt beim Server angekommen ist.'],
        ],
    ],

    'reach' => [
        'label' => 'Netzwerk',
        'title' => 'Erreichbar werden',
        'lede'  => 'Mit dem Relay des Launchers kannst du diesen Abschnitt meistens überspringen. Klappt es bei dir nicht, gibt es zwei Wege, und der zweite ist einfacher.',

        'forward' => [
            'label' => 'Einen Port weiterleiten',
            'body'  => 'Leite <strong>:protocol :port</strong> im Router auf den PC mit dem Server weiter, gib der Maschine eine feste DHCP-Reservierung, damit die Regel nicht verrutscht, und erlaube sie in der Windows-Firewall. Dann gibst du deine öffentliche Adresse weiter. <code>api.ipify.org</code> verrät sie dir, und dein Provider kann sie nach einem Router-Neustart ändern.',
            'rule'  => 'Eine Zeile im Terminal (als Administrator), einmalig:',
            'cmd'   => 'New-NetFirewallRule -DisplayName "Skyrim Together Server (UDP :port)" -Direction Inbound -Protocol UDP -LocalPort :port -Action Allow -Profile Any',
        ],

        'vpn' => [
            'label' => 'Oder den Router weglassen',
            'body'  => 'Setz alle in ein virtuelles LAN (Tailscale, ZeroTier oder Radmin VPN) und gib die Adresse weiter, die es dir nennt. Keine Portweiterleitung, keine öffentliche IP, nichts im offenen Internet, und es überlebt den Adresswechsel durch den Provider. Für zwei oder drei Freunde ist das fast immer die richtige Antwort.',
        ],

        'self' => 'Auf dem PC zu hosten, auf dem du spielst, ist normal und vorgesehen. Du verbindest dich mit dir selbst über <code>127.0.0.1::port</code>, dieselbe Adresse wie alle anderen, nur ohne den Weg.',
    ],

    'settings' => [
        'label' => 'Konfiguration',
        'title' => 'Server-Einstellungen',
        'lede'  => 'Bearbeite <code>Server\\config\\STServer.ini</code> bei geschlossenem Server. Diese hier lohnen sich zu kennen.',
        'head'  => ['setting' => 'Einstellung', 'default' => 'Standard', 'what' => 'Was sie tut'],
        'rows'  => [
            ['k' => 'uPort',             'v' => ':port',  'd' => 'Der UDP-Port, auf dem sich Spieler verbinden. Änderst du ihn, ändere die Weiterleitungsregel mit.'],
            ['k' => 'sPassword',         'v' => 'leer',   'd' => 'Setz eines, um Fremde draußen zu halten. Spieler tragen es in Zeile zwei ihrer connect.txt ein.'],
            ['k' => 'bAutoPartyCreate',  'v' => 'true',   'd' => 'Der erste Spieler auf dem Server bekommt eine Gruppe, damit niemand in VR ein Gruppenmenü suchen muss.'],
            ['k' => 'bAutoPartyJoin',    'v' => 'true',   'd' => 'Alle anderen treten automatisch bei. Nötig für geteiltes Wetter und geteilte Quests.'],
            ['k' => 'bEnablePvp',        'v' => 'false',  'd' => 'Ob Spieler einander Schaden zufügen können. Denk an eure Freundschaften, bevor du das änderst.'],
            ['k' => 'bEnableDeathSystem','v' => 'true',   'd' => 'Der Tod lässt dich in einem Tempel wieder erscheinen, statt einen Spielstand zu laden, was die Welt desynchronisieren würde.'],
            ['k' => 'bAllowMO2',         'v' => 'true',   'd' => 'Erlaubt über Mod Organizer 2 gestartete Clients. Anlassen.'],
            ['k' => 'bAllowSKSE',        'v' => 'true',   'd' => 'Erlaubt SKSE. Anlassen; ohne läuft hier gar nichts.'],
            ['k' => 'bEnableModCheck',   'v' => 'false',  'd' => 'Erzwingt bytegleiche Modlisten. Absichtlich aus. Nah genug ist nah genug.'],
        ],
    ],

    'rules' => [
        'label' => 'Stolperfallen',
        'title' => 'Zwei Regeln, die beißen',
        'items' => [
            ['title' => 'Builds, die dieselben Nachrichten sprechen, verbinden sich', 'body' => 'Egal, welche Versionsnummer sie tragen. Eine Veröffentlichung, die die Netzwerknachrichten ändert, sagt das, und dann aktualisieren alle, der Server eingeschlossen. Wer abgelehnt wird, bekommt beide Versionen genannt, im Spiel und im Ladebildschirm des Launchers.'],
            ['title' => 'uGridsToLoad bleibt bei 5','body' => 'Der Server lehnt jeden anderen Wert ab. Das ist der Standard jeder Liste, also erwischt es nur die, die herumgeschraubt haben.'],
        ],
    ],

    'linux' => [
        'title' => 'Linux',
        'body'  => 'Die Linux-Build des dedizierten Servers lässt sich mit dem aktuellen Code im Moment nicht bauen. Früher ging das, und es wird gerade behoben. Frag bis dahin nach.',
    ],

    'cta' => [
        'title'   => 'Server läuft. Hol alle rein',
        'body'    => 'Schick ihnen die Adresse, die Build und die Anleitung.',
        'primary' => 'Zur Anleitung',
        'secondary' => 'Build herunterladen',
    ],
];
