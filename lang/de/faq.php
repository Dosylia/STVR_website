<?php

return [

    'meta' => [
        'title'       => 'Skyrim Together VR: Fragen',
        'description' => 'Läuft es mit meiner Modliste? Kostet es etwas? Werde ich gebannt? Kann ich mit jemandem auf Special Edition spielen? Antworten.',
    ],

    'hero' => [
        'kicker' => 'Die, die jede Woche kommen',
        'title'  => 'Fragen',
        'lede'   => 'Kurze Antworten. Und dort, wo eine kurze Antwort gelogen wäre, eine längere.',
    ],

    'groups' => [

        [
            'title' => 'Die Grundlagen',
            'items' => [
                [
                    'q' => 'Was ist das, in einem Satz?',
                    'a' => 'Eine kostenlose, quelloffene Mod, mit der ihr Skyrim VR gemeinsam spielt, auf einem Server, den einer von euch betreibt.',
                ],
                [
                    'q' => 'Kostet es etwas?',
                    'a' => 'Nein, und es kann auch nichts kosten. Die Lizenz ist die GPLv3, geerbt von Skyrim Together Reborn: der Quellcode bleibt öffentlich, und jeder kann ihn selbst bauen. Du brauchst deine eigene Kopie von Skyrim VR, mehr nicht.',
                ],
                [
                    'q' => 'Ist das dasselbe wie Skyrim Together Reborn?',
                    'a' => 'Es ist dieselbe Mod, portiert. Reborn ist für Skyrim Special Edition: eine andere Programmdatei mit anderen Speicheradressen und ohne alles, was VR ist. Jeder Engine-Hook musste für die VR-Build neu gefunden werden, und alles, was mit Händen und Headsets zu tun hat, gab es dort überhaupt nicht. Der Mehrspielerteil darunter ist die Arbeit von Tilted Phoques, und die Anerkennung gehört ihnen.',
                ],
                [
                    'q' => 'Kann ich mit jemandem auf Special Edition spielen?',
                    'a' => 'Nein. Andere Programmdatei, andere Build, anderer Weltaufbau. Ihr braucht beide Skyrim VR.',
                ],
                [
                    'q' => 'Mit wie vielen Leuten geht das?',
                    'a' => 'Gebaut und getestet ist es für kleine Gruppen: zwei bis vier Freunde. Es gibt kein technisches Lobby-Limit, aber niemand hat es in eine Menschenmenge geführt, und die ehrliche Antwort ist, dass eine Menge die rauen Kanten schneller finden würde, als dir lieb ist.',
                ],
            ],
        ],

        [
            'title' => 'Mods und Kompatibilität',
            'items' => [
                [
                    'q' => 'Läuft es mit meiner Modliste?',
                    'a' => 'Vermutlich, und genau das ist der Punkt. Es lädt neben dem, was du ohnehin spielst, über MO2, Vortex oder eine Wabbajack-Liste. Die einzige harte Bedingung ist, dass <code>uGridsToLoad</code> auf 5 bleibt.',
                ],
                [
                    'q' => 'Brauchen wir beide dieselben Mods?',
                    'a' => 'Nicht bytegleich. Die Mod-Prüfung ist absichtlich aus. Aber je näher die beiden Listen beieinander sind, desto weniger Überraschungen. Alles, was verändert, was in der Welt existiert oder was eine Kreatur ist, führt irgendwann zu »er sieht einen Bären, ich sehe einen Wolf«.',
                ],
                [
                    'q' => 'Brauche ich VRIK?',
                    'a' => 'Technisch nein. Praktisch ja. VRIK gibt dir einen Körper, und dein Körper ist das, was dein Freund sieht. Ohne VRIK bist du immer noch da, nur deutlich weniger von dir.',
                ],
                [
                    'q' => 'Läuft es mit Wabbajack-Listen wie FUS?',
                    'a' => 'Ja. Gegen FUS wird es im Alltag entwickelt. Installiere den Mod-Ordner wie jede andere Mod und trag den Launcher als Programm ein.',
                ],
                [
                    'q' => 'Läuft es auf der Quest?',
                    'a' => 'Nur über PC-VR: Virtual Desktop, Air Link, ein Kabel. Das ist eine PC-Mod für das PC-Spiel; ein Standalone-Headset hat kein Skyrim VR zum Modden.',
                ],
            ],
        ],

        [
            'title' => 'Sicherheit und Vernunft',
            'items' => [
                [
                    'q' => 'Kann ich davon gebannt werden?',
                    'a' => 'Es gibt nichts, wovon man gebannt werden könnte. Skyrim VR hat weder Anti-Cheat noch Online-Komponente, und das hier spricht nie mit einem Server, der uns gehört. Deine Spielstände gehören dir, auf deiner Platte.',
                ],
                [
                    'q' => 'Warum ersetzt der Launcher die Programmdatei des Spiels?',
                    'a' => 'Weil man so in ein Spiel hineinkommt, dessen Code auf der Platte verschlüsselt ist. Es ist auch genau die Form von Sache, der man misstrauen sollte, also: der Quellcode ist öffentlich, die Lizenz hält ihn öffentlich, und die Veröffentlichung wird von einem Skript aus demselben Repository gebaut. Sie selbst zu kompilieren ist eine unterstützte Antwort.',
                ],
                [
                    'q' => 'Kann das meinen Spielstand zerstören?',
                    'a' => 'Bisher nicht, und es ist nicht darauf ausgelegt, irgendetwas Dauerhaftes hineinzuschreiben. Sichere deine Spielstände trotzdem. Du betreibst eine Alpha einer VR-Portierung einer Mehrspieler-Mod; eine Kopie kostet dich nichts, die Alternative kostet dich einen Spieldurchgang.',
                ],
                [
                    'q' => 'Ist meine IP-Adresse sichtbar?',
                    'a' => 'Für den, der den Server betreibt, und für alle darauf: ja, wie in jedem Spiel, in dem ein Freund hostet. Wenn dich das stört, nimm ein virtuelles LAN wie Tailscale oder ZeroTier statt einer Portweiterleitung; dann ist nichts mehr aus dem offenen Internet erreichbar.',
                ],
            ],
        ],

        [
            'title' => 'Wie weit es ist',
            'items' => [
                [
                    'q' => 'Ist es fertig?',
                    'a' => 'Nein. Es ist spielbar, was etwas anderes und sehr viel jünger ist. Es stürzt ab, NPCs landen gelegentlich unter dem Boden, und Leichen sind sich zwischen den Headsets nicht immer einig. Der Fahrplan nennt die sechs Dinge, die behoben werden, der Reihe nach.',
                ],
                [
                    'q' => 'Etwas ist kaputtgegangen. Was braucht ihr von mir?',
                    'a' => 'Führe <code>collect-logs.bat</code> im Launcher-Ordner aus und schick das Zip, das auf deinem Desktop landet. Darin sind das Client-Log, der Crashdump und die Build-Versionen. Ein Dump benennt die genaue Funktion; eine Beschreibung benennt ein Gefühl.',
                ],
                [
                    'q' => 'Wird es eine Nexus-Seite geben?',
                    'a' => 'Ja, sobald die Absturzliste kurz genug ist, dass ein Erstbesucher einen guten Abend hat statt eines interessanten.',
                ],
                [
                    'q' => 'Kann ich helfen?',
                    'a' => 'Ja. Spielen und präzise berichten ist mehr wert, als es klingt. Das meiste, was behoben wurde, wurde in irgendjemandes Log gefunden. Wenn du Reverse Engineering machst: es gibt noch eine kurze Liste von Engine-Adressen ohne VR-Zuordnung, und das Repository erklärt, wie die anderen gefunden wurden.',
                ],
            ],
        ],
    ],

    'cta' => [
        'title'   => 'Hier nicht beantwortet?',
        'body'    => 'Mach ein Ticket auf, oder frag einfach.',
        'primary' => 'Auf GitHub fragen',
    ],
];
