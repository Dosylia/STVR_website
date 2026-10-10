---
title: Ein Server, dem jeder beitreten kann
date: 2026-10-10
summary: Ein öffentlicher Server, eine Seite, die zeigt, wer drauf ist und wo, und wie die Karte unterwegs dreimal jemanden verloren hat.
tags: netzwerk, website
---

Jede Art zu spielen fängt bisher damit an, dass man jemanden kennt. Einer von euch hostet,
der andere bekommt einen Code. So werden die meisten immer spielen, und als Standard ist das
richtig. Aber wer die Mod installiert hat, einen freien Abend vor sich und niemanden zum
Mitspielen, bleibt dabei außen vor.

Also bauen wir einen öffentlichen Server: einen, der immer läuft und auf den jeder kann, und
dazu eine Seite auf dieser Website, die zeigt, wer gerade drauf ist und wo. Offen ist er noch
nicht. Hier steht, was es schon gibt und was dafür nötig war.

## Woher die Seite es weiß

Der Server meldet unserem Hub seinen Status: seinen Namen, seine Adresse, seine Build, wie
viele Spieler drauf sind und zu jedem Spieler den Namen des Charakters und wo er steht. Alle
10 Sekunden, solange jemand verbunden ist, einmal pro Minute, wenn niemand da ist, und noch
ein letztes Mal, als offline markiert, wenn er ordentlich beendet wird.

Das tut er nur auf dem öffentlichen Server. Auf jedem anderen Server ist die Einstellung aus,
auch auf dem eines Freundes, und sie braucht einen Schlüssel, den nur der Rechner des
öffentlichen Servers und der Hub haben.

Der Hub behält den neuesten Status und nichts Älteres. Bleibt der Server drei Minuten lang
still, meldet der Hub ihn als offline und streicht die Spieler aus dem Status. Gespeichert
wird nichts darüber, wer gespielt hat oder wann.

Über einen Spieler wird der Name des Charakters gesendet, nie ein Steam-Name, ein Konto oder
eine Adresse.

## Den Hub nicht zu oft fragen

Der Hub läuft in einem kostenlosen Tarif: 100.000 Anfragen am Tag, für alles, was er tut,
Absturzberichte und Einladungscodes eingeschlossen. Eine Seite, die sich im Browser jedes
Besuchers selbst aktualisiert, würde das an einem Nachmittag verbrauchen: hundert Leute
schauen zu, jeder mit einer Anfrage alle paar Sekunden.

Deshalb fragen Browser nie den Hub. Sie fragen diese Website, die die letzte Antwort 5
Sekunden lang behält und erst wieder beim Hub nachfragt, wenn ein Besucher fragt und ihre
Kopie älter ist als das. Egal wie viele zusehen: Der Hub hört höchstens alle 5 Sekunden
einmal von uns, und gar nicht, wenn niemand hinschaut.

## Dreimal hat die Karte Leute verloren

Die Seite zeichnet jeden Spieler als Punkt auf unsere eigene Karte von Himmelsrand. Der Punkt
bewegt sich mit dem Spieler und dreht sich, um zu zeigen, in welche Richtung er blickt. Bis
die Punkte am richtigen Ort saßen, brauchte es drei Anläufe.

**Zuerst die Städte.** In den Daten des Spiels sind Weißlauf, Einsamkeit, Windhelm, Rifton
und Markarth jeweils eine eigene Welt, getrennt vom Rest von Himmelsrand. Wer durch das Tor
von Weißlauf ging, verschwand von der Karte. Die Städte teilen aber die Koordinaten von
Himmelsrand, also werden sie jetzt auf derselben Karte gezeichnet.

**Dann die DLCs.** Wer nach Solstheim reiste oder durch das Portal ins Seelengrab ging,
verschwand genauso. Das sind echte Orte mit eigenem Boden und eigenen Koordinaten, also hat
jeder eine eigene Karte bekommen: Solstheim, im Norden unter Schnee und im Süden unter Asche,
und das Seelengrab, eine violette Leere mit Inseln aus grauem Boden. Die Seite zeigt sie als
Tabs, jeden mit der Zahl der Spieler dort, und öffnet zuerst den, auf dem am meisten los ist.

**Dann die Kalibrierung.** Aus einer Position im Spiel wird ein Punkt auf einer Zeichnung,
und zwar über zwei Orte, deren Lage im Spiel und auf der Zeichnung bekannt ist. Wir haben mit
Schätzungen für Weißlauf und Windhelm angefangen. Als der Server anfing, genaue Positionen für
die Festung Dämmerwacht und für Burg Volkihar zu senden, stellte sich heraus, dass die
Schätzungen die Festung 80 Pixel neben die Stelle setzten, an der sie gezeichnet ist, und die
Burg sogar ganz außerhalb der Karte. Die Karte von Himmelsrand wird jetzt anhand dieser
beiden genauen Punkte ausgerichtet, je einer in einer Ecke. Die Orte dazwischen sind nach
Augenmaß gezeichnet, und eine Messung auf dem Markt von Weißlauf wird uns zeigen, wie weit
sie danebenliegen.

## Der Seite fernbleiben

Nicht jeder will seinen Charakter auf einer öffentlichen Seite sehen. Wer sich verbirgt,
steht nicht in der Liste, erscheint überhaupt nicht auf der Karte und wird nur mitgezählt:
Die Seite sagt »5 Spieler« und »Dazu ein weiterer Spieler, der nicht aufgeführt ist.«

## Stand

Gebaut: die Statusmeldung des Servers, der Teil im Hub und die Seite mit ihren drei Karten,
den Live-Punkten, der Spielerliste und einem Knopf, der zum Beitreten den Launcher öffnet.

Noch nicht: Der Server selbst ist nicht offen. Bevor er öffnet, braucht der Server seinen
Schlüssel, die Karte von Solstheim eine Messung an zwei Orten und die des Seelengrabs an
einem, und die Regeln müssen noch geschrieben werden. Ortsnamen in der Liste kommen mit der
nächsten Build der Mod. Die Option zum Verbergen und das Beitreten mit einem Klick kommen mit
der Launcher-Version, mit der der Server öffnet.

Wenn es so weit ist, findest du ihn im Menü dieser Website, und hier.
