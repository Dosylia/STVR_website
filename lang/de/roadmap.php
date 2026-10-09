<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: Fahrplan und bekannte Fehler',
        'description' => 'Die sechs Dinge, die behoben werden, in der Reihenfolge, in der sie es wert sind, und eine ehrliche Liste dessen, was heute kaputtgeht.',
    ],

    'hero' => [
        'kicker' => 'Sechs Ziele · der Reihe nach',
        'title'  => 'Was als Nächstes kommt, und was kaputt ist',
        'lede'   => 'Das ist die echte Liste, in der echten Reihenfolge. Nichts darauf gilt als erledigt, weil es aufgeschrieben wurde; Dinge verschwinden von ihr, wenn die Leute, die spielen, aufhören, sie zu melden.',
    ],

    'constellation' => [
        'label' => 'Der Weg',
        'title' => 'Die sechs',
        'lede'  => 'Sortiert danach, was zuerst behoben gehört, nicht danach, was am leichtesten ist. Alles andere wird an dieser Liste gemessen.',
        'legend' => [
            'active' => 'In Arbeit',
            'next'   => 'Als Nächstes',
            'later'  => 'Danach',
        ],
        'goals' => [
            [
                'n' => 1,
                'state' => 'active',
                'title' => 'Keine Abstürze mehr',
                'body'  => 'Alles andere ist Dekoration, wenn die Sitzung nach zwanzig Minuten endet. Der Großteil der Arbeit dieses Monats steckt hier: Null-Prüfungen durch jeden Hook, Abbaupfade, die keinen gelöschten Akteur mehr an Code übergeben, der ihn noch hält, und ein Crashdump-Werkzeug, das die Funktion benennt, statt zum Raten einzuladen.',
            ],
            [
                'n' => 2,
                'state' => 'active',
                'title' => 'Die Welt, in beiden Headsets gleich',
                'body'  => 'Hast du es getötet, ist es auch für ihn tot; hat er die Truhe geplündert, ist sie für dich leer. Der lange Rest sind Zellgrenzen. Sie schnell zu überqueren ist die Quelle der seltsamsten Meldungen.',
            ],
            [
                'n' => 3,
                'state' => 'next',
                'title' => 'VRIK-Interaktionen, für alle sichtbar',
                'body'  => 'VR hat Gesten, die ein flaches Spiel nie hatte: über die Schulter greifen, an der Hüfte einstecken, etwas aus der Luft fangen. Genau die lassen einen Körper als Person lesen, und sie müssen als sie selbst über die Leitung gehen, nicht als die nächstbeste passende Animation.',
            ],
            [
                'n' => 4,
                'state' => 'active',
                'title' => 'Leichen, die liegen bleiben, wo man sie hinlegt',
                'body'  => 'Leichen ziehen funktioniert, und beide Spieler sehen es. Eine Leiche liegt jetzt in beiden Welten am selben Ort. Was noch fehlt: der Körper eines anderen Spielers und lebende NPCs.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Niemand unter dem Boden',
                'body'  => 'NPCs landen gelegentlich unterhalb des Bodens, auf dem sie stehen sollten. Sie sind synchron, nur eben auf der falschen Höhe.',
            ],
            [
                'n' => 6,
                'state' => 'active',
                'title' => 'Treffer landen dort, wo die Waffe ist',
                'body'  => 'Treffen zwei Klingen aufeinander, spüren, hören und sehen das beide Spieler, und der Bildschirm des Verteidigers entscheidet, ob ein Treffer pariert wurde. Ab der nächsten Veröffentlichung pariert nur eine Waffe oder ein Schild. Als Nächstes: Klingen, die einander wirklich aufhalten.',
            ],
        ],
    ],

    'issues' => [
        'label' => 'Heute',
        'title' => 'Bekannte Fehler',
        'lede'  => 'Aktuell, konkret, und keine Formalie. Triffst du auf etwas, das hier nicht steht, ist es wirklich neu. Schick das Log.',
        'items' => [
            [
                'title' => 'Es stürzt immer noch ab',
                'body'  => 'Seltener als früher, und was übrig ist, dreht sich meist um viele gleichzeitig abgebaute Akteure. <code>collect-logs.bat</code> gibt uns den Dump, und der Dump benennt die Funktion.',
            ],
            [
                'title' => 'Zellen schnell zu überqueren wird seltsam',
                'body'  => 'Ein in den Himmel geschleuderter Bandit, eine Leiche am falschen Ort, eine Spriggan, deren Treffer nie landen, alles gemeldet beim Sprint quer durchs Land, und genau an diesem Faden wird gerade gezogen.',
            ],
            [
                'title' => 'NPCs unter dem Bodenniveau',
                'body'  => 'Korrekt synchronisiert, am falschen Ort. Meist kosmetisch, gelegentlich tödlich für einen Kampf.',
            ],
            [
                'title' => 'Bewegte Körper können sich noch uneinig sein',
                'body'  => 'Eine Leiche liegt jetzt in beiden Welten am selben Ort, und wenn jemand eine zieht, sehen es beide Spieler. Der Körper eines anderen Spielers und bewegte lebende NPCs können noch an verschiedenen Orten landen.',
            ],
            [
                'title' => 'PvP ist jung',
                'body'  => 'Parieren ist neu. Am 8. und 9. Oktober wurden drei Wege gefunden, auf denen ein Treffer trotz Parade durchkam, und alle drei sind für die nächste Veröffentlichung behoben. In einem der beiden Spiele hält die Kopie des anderen Spielers manchmal keine Waffe, und dann lässt sie sich nicht parieren.',
            ],
            [
                'title' => 'Hosten über das Relay ist neu',
                'body'  => 'In Betrieb seit :relay_since und noch nicht über eine ganze Sitzung erprobt. Kommt ein Freund nicht rein, leite den Port weiter oder nimm Tailscale, wie auf der Hosting-Seite beschrieben.',
            ],
            [
                'title' => 'Vortex älter als :vortex_min',
                'body'  => 'Der Launcher kopiert die Dateien wie bisher nach Data, und sie tauchen nicht in der Modliste von Vortex auf. Vortex zu aktualisieren behebt das.',
            ],
            [
                'title' => 'Begleiter können weit zurückfallen',
                'body'  => 'Reise schnell, und dein Begleiter ist vielleicht mehrere Zellen hinter dir. Der Client gibt Akteure in Zellen frei, die das Spiel entladen hat: korrektes Verhalten mit einem Ergebnis, das nicht danach aussieht.',
            ],
        ],
        'report' => [
            'title' => 'Wenn du einen neuen findest',
            'body'  => 'Führe <code>collect-logs.bat</code> im Launcher-Ordner aus. Es legt ein Zip auf dem Desktop ab, mit Client-Log, eventuellem Crashdump und beiden Build-Versionen. Dieses Zip ist der Unterschied zwischen einer Behebung diese Woche und einer Theorie diesen Monat.',
            'cta'   => 'Ticket öffnen',
        ],
    ],

    'done' => [
        'label' => 'Hinter uns',
        'title' => 'Kürzlich von der Liste',
        'lede'  => 'Kein Changelog. Das Entwicklertagebuch ist das Changelog. Nur die Form der letzten Wochen.',
        'items' => [
            'Ein Launcher: installieren, prüfen, spielen, hosten und mit einem Code beitreten.',
            'Hosten, ohne einen Port zu öffnen, über ein Relay von uns.',
            'Treffen zwei Klingen aufeinander, spüren, hören und sehen das beide Spieler.',
            'Eine Begleiterin gehört zum Spiel des Spielers, dem sie folgt.',
            'Eine Leiche liegt in beiden Welten am selben Ort.',
            'Crashdumps, die klein genug zum Senden sind.',
            'Unbeaufsichtigte Bot-Tests: eine Regression findet nachts eine Maschine statt freitags ein Freund.',
        ],
    ],

    'cta' => [
        'title'   => 'Lies, wie es wirklich lief',
        'body'    => 'Im Tagebuch stehen auch die Irrwege.',
        'primary' => 'Tagebuch öffnen',
    ],
];
