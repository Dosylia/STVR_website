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
                'state' => 'next',
                'title' => 'Leichen, die liegen bleiben, wo man sie hinlegt',
                'body'  => 'Erst das Ziehen von Leichen, dann der Umgang mit dem Körper eines anderen Spielers und mit lebenden NPCs. Eine Leiche, die im einen Headset in einen Türrahmen gezogen wurde und im anderen offen liegt, ist genau die Sorte Sache, die man im schlechtesten Moment bemerkt.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Niemand unter dem Boden',
                'body'  => 'NPCs landen gelegentlich unterhalb des Bodens, auf dem sie stehen sollten. Sie sind synchron, nur eben auf der falschen Höhe.',
            ],
            [
                'n' => 6,
                'state' => 'later',
                'title' => 'Treffer landen dort, wo die Waffe ist',
                'body'  => 'Ein Schwung in VR ist ein echter Schwung, keine ausgelöste Animation, und das Spiel des anderen muss sich einig sein, wo der Stahl tatsächlich entlanggegangen ist. Schwerter haben schon Gewicht; die Trefferabfrage muss es sich noch verdienen.',
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
                'title' => 'Leichen sind sich uneinig',
                'body'  => 'Ziehen funktioniert besser als früher. Zwei Spieler am selben Körper, oder ein aus der Ferne bewegter Körper, landen noch nicht immer in beiden Welten am selben Ort.',
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
            'Fallen gelassene Gegenstände folgen der Hand, die sie geworfen hat, und erreichen den Boden, statt zu schweben.',
            'Die Hüfte geht über die Leitung, also beugt sich ein Körper dort, wo sich sein Besitzer beugt.',
            'Eine entfernte Kopie, die außer Reichweite gerät und zurückkommt, kommt korrekt zurück.',
            'Schwerter haben Gewicht.',
            'Eine Gegner-Lebensanzeige schreibt nicht mehr in ein bereits geschlossenes Menü.',
            'Unbeaufsichtigte Bot-Tests: eine Regression findet nachts eine Maschine statt freitags ein Freund.',
        ],
    ],

    'cta' => [
        'title'   => 'Lies, wie es wirklich lief',
        'body'    => 'Im Tagebuch stehen auch die Irrwege.',
        'primary' => 'Tagebuch öffnen',
    ],
];
