<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: Datenschutz',
        'description' => 'Was ein Absturzbericht enthält und wie er nach :days Tagen gelöscht wird, was Einladungscodes und das Relay speichern, und die zwei Cookies, die diese Seite setzt.',
    ],

    'hero' => [
        'kicker' => 'Absturzberichte, Hosten und deine Daten',
        'title'  => 'Datenschutz',
        'lede'   => 'Was ein Absturzbericht enthält, was das Hosten über uns speichert, was diese Seite setzt, und wie lange.',
    ],

    'discord' => 'unserem Discord-Server',

    'sections' => [

        [
            'title' => 'Nichts geht ohne ein Ja',
            'body'  => [
                'Wenn sich das Spiel nach einem Absturz schließt, fragt der Launcher, ob er einen Bericht darüber senden darf. Du kannst nur für diesen Absturz antworten, ja oder nein, oder einmal für alle: immer oder nie. Immer und nie lassen sich später in den Einstellungen des Launchers ändern.',
                'Hat sich das Spiel geschlossen, während du im Headset warst, wartet die Frage, bis du den Launcher das nächste Mal öffnest. Wer das Fenster ohne Antwort schließt, sendet nichts.',
            ],
        ],

        [
            'title' => 'Was ein Bericht enthält',
            'body'  => ['Nur Dateien zum Absturz, und nur vom letzten Tag:'],
            'items' => [
                'Das eigene Log der Mod: womit sie sich verbunden hat, was sie zwischen den beiden Spielen abgeglichen hat und auf welche Fehler sie gestoßen ist.',
                'Der Bericht von Crash Logger zu jedem Absturz: wo im Code des Spiels er passiert ist, deine Liste von Plugins und SKSE-Plugins, deine Windows-Version und die Teile deines PCs (Prozessor, Grafikkarte, Arbeitsspeicher, Headset-Modell).',
                'Das Log des Servers, falls du gehostet hast.',
                'Die Version der Mod, die du benutzt hast.',
                'Ein kleiner Speicherauszug von ein paar Megabyte: was die Threads des Spiels im Moment des Absturzes gerade taten. Er kann kleine Bruchstücke von dem enthalten, was das Spiel in diesem Augenblick im Speicher hatte.',
                'Deine Antwort auf eine Frage: Ist es abgestürzt, während du gespielt hast?',
            ],
        ],

        [
            'title' => 'Was vorher entfernt wird',
            'body'  => ['Auf deinem PC, bevor irgendetwas gesendet wird, in jeder Datei, auch im Speicherauszug:'],
            'items' => [
                'Dein Windows-Benutzername, wo immer er in einem Dateipfad steht.',
                'Jede IP-Adresse und jede Serveradresse.',
                'Deine Discord-ID.',
                'Namen von Spielern und Charakteren, ersetzt durch „Spieler A“, „Spieler B“ und so weiter.',
            ],
        ],

        [
            'title' => 'Was deinen PC nie verlässt',
            'items' => [
                'Deine Spielstände.',
                'Screenshots und Bilder jeder Art.',
                'Vollständige Speicherauszüge. Sie sind Hunderte Megabyte groß und enthalten weit mehr vom Speicher des Spiels, als ein Bericht braucht.',
                'Deine Mods, deine Einstellungsdateien und die Dateien deiner Modliste.',
                'Alles, was auf dieser Seite nicht genannt ist.',
            ],
        ],

        [
            'title' => 'Warum wir fragen',
            'body'  => [
                'Ein Absturz auf einem anderen PC, mit einer anderen Modliste, ist von hier aus unsichtbar, solange ihn niemand schickt. Das meiste, was bisher behoben wurde, fand sich im Log von irgendjemandem.',
                'Berichte werden bei uns von einem Programm sortiert, das gleiche Abstürze zusammenfasst und nach Häufigkeit und Zahl der Betroffenen ordnet. Es liest Logs; über dich entscheidet es nichts. Berichte dienen dazu und zu nichts anderem: keine Werbung, kein Tracking, nichts wird verkauft oder weitergegeben.',
            ],
        ],

        [
            'title' => 'Wohin er geht und wer ihn liest',
            'body'  => [
                'Ein Bericht reist verschlüsselt (HTTPS) zu einem kleinen Dienst von uns, der bei Cloudflare läuft, und wird dort aufbewahrt. Lesen können ihn nur die Leute, die an der Mod arbeiten: heute zwei Personen.',
                'Wie jeder Webserver sieht dieser Dienst die Adresse, von der ein Bericht kommt. Er behält eine verschleierte Form davon (einen Einweg-Hash) eine Stunde lang, um Berichte zu zählen und Fluten zu stoppen, und speichert die Adresse nie zusammen mit dem Bericht.',
                'Wenn ein Bericht ankommt, erscheint eine kurze Zeile in einem privaten Kanal auf :discord: seine Nummer, seine Größe, die Version der Mod, ob es beim Spielen abgestürzt ist, und um welchen Absturz es sich handelt, mit seinem Namen, wenn wir ihn schon kennen, oder der Stelle im Code des Spiels, an der er passiert ist. Nie die Logs selbst.',
            ],
        ],

        [
            'title' => 'Wie lange er aufbewahrt wird',
            'body'  => [
                'Jeder Bericht wird :days Tage nach seiner Ankunft automatisch gelöscht, im Dienst und auf dem PC, auf dem Berichte gelesen werden.',
            ],
        ],

        [
            'title' => 'Einen Bericht löschen lassen',
            'body'  => [
                'Nach dem Senden zeigt der Launcher die Nummer des Berichts und führt eine Liste der Nummern, die er gesendet hat. Nenn eine Nummer auf :discord, und dieser Bericht wird überall gelöscht, ohne Rückfragen.',
                'Wähl im Launcher „nie“, und ab dann wird nichts mehr gesendet.',
            ],
        ],

        [
            'title' => 'Einladungscodes',
            'body'  => [
                'Wenn du mit dem Launcher hostest, speichert unser Hub (derselbe Cloudflare-Dienst, der die Berichte empfängt) deine öffentliche Adresse und deinen Port, ob der Server ein Passwort hat (nie das Passwort selbst), die Version des Launchers und, falls es eine gibt, die Relay-Sitzung. Er behält das :invite_hours Stunden lang; der Launcher erneuert es stündlich, solange du hostest, und entfernt es, wenn du aufhörst.',
                'Wer den Code hat, bekommt die Adresse. Solange du hostest, sehen deine Steam-Freunde „Hosting urSovngarde“, und ihr Launcher kann den Code lesen.',
            ],
        ],

        [
            'title' => 'Das Relay',
            'body'  => [
                'Läuft das Hosten über das Relay, geht der Datenverkehr des Spiels zwischen dir und deinen Freunden über einen Server, den wir bei IONOS mieten, in einem Rechenzentrum in Deutschland: derselbe Server wie diese Website. Der Datenverkehr ist durch die eigene Netzwerktechnik des Spiels verschlüsselt, und das Relay kann ihn nicht lesen.',
                'Das Relay speichert keine Adressen in seinen Logs. Einmal pro Minute schreibt es nur Zahlen: Sitzungen, Spieler, Pakete und Bytes. Eine Sitzung vergisst es 60 Sekunden, nachdem sie still geworden ist.',
            ],
        ],

        [
            'title' => 'Diese Website',
            'body'  => [
                'Die Seite setzt zwei Cookies, beide unbedingt erforderlich und beide nach zwei Stunden verschwunden: <code>skyrim-together-vr-session</code>, mit dem das Framework der Seite einen Besuch zusammenhält, und <code>XSRF-TOKEN</code>, ein Sicherheitstoken gegen gefälschte Formulare. Es gibt kein Tracking, keine Analyse und keine Werbung, und deshalb gibt es auch kein Cookie-Banner.',
                'Wie jeder Webserver führt unserer ein Zugriffsprotokoll, das die Adresse und den Zeitpunkt jeder Anfrage festhält.',
                'Wenn der Launcher von dieser Website heruntergeladen wird oder ein installierter Launcher fragt, ob es ein Update gibt, meldet die Website das unserem Hub, der den Zähler des Tages um eins erhöht (bei einem Download auch den dieser Version). Nichts darüber, wer heruntergeladen hat, wird übermittelt.',
            ],
        ],

        [
            // Shown only once the public server page is switched on (config stvr.public_server.enabled).
            'when'  => 'public_server',
            'title' => 'Der öffentliche Server',
            'body'  => [
                'Die Seite des öffentlichen Servers auf dieser Website zeigt allen live, welche Charaktere gerade auf ihm sind und an welchem Ort sich jeder befindet, so wie das eigene Spiel des jeweiligen Spielers diesen Ort nennt. Draußen zeigt sie außerdem das Gebiet, in dem sie sich befinden (Himmelsrand, Solstheim, das Seelengrab ...), und auf unseren Karten von Himmelsrand und Solstheim, wo sie stehen und in welche Richtung sie blicken. Nur Charakternamen: nie ein Steam-Name, ein Konto oder eine Adresse.',
                'Du kannst der Seite fernbleiben: im Launcher mit „Mich auf der Seite des öffentlichen Servers verbergen“. Ab deinem nächsten Beitritt zählt die Seite dich weiterhin mit, zeigt aber nie deinen Namen und setzt dich nicht auf ihre Karte.',
                'Das macht nur unser öffentlicher Server. Auf jedem anderen Server, auch auf deinem, ist die Einstellung aus.',
                'Solange jemand spielt, schickt der Server alle 10 Sekunden seinen Status an unseren Hub. Der Hub behält nur den neuesten, entfernt die Spieler daraus, sobald der Server beendet wird oder 3 Minuten lang still geblieben ist, und speichert nichts darüber, wer gespielt hat oder wann.',
            ],
        ],
    ],
];
