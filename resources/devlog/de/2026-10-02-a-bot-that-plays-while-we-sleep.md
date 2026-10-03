---
title: Ein Bot, der spielt, während wir schlafen
date: 2026-10-02
summary: Eine Regression an einem Freitagabend zu finden, mit einem Freund im Headset, ist die teuerste Art, eine Regression zu finden.
tags: tests, werkzeuge
---

Den größten Teil dieses Projekts über bestand die Testsuite aus zwei Leuten in Headsets an
einem Freitagabend.

Das hat echte Vorteile. Es findet, worauf es ankommt, weil die einzigen gemeldeten Fehler
die sind, die etwas ruiniert haben. Es hat auch ein offensichtliches Problem: die
Rückmeldeschleife dauert eine Woche, sie kostet zwei Leute einen Abend, und ungefähr die
Hälfte der Information kommt als »da wurde es komisch, in der Nähe vom Banditenlager«.

Also gibt es jetzt einen Bot. Er fährt den Client ohne Anzeige hoch, verbindet sich mit
einem Server und spielt eine Reihe geskripteter Paare durch: zwei Clients, je ein Szenario,
ein bekannter erwarteter Endzustand.

## Was er tatsächlich fängt

Kein Gameplay. Der Bot hat keine Meinung dazu, ob sich Kampf gut anfühlt. Was er fängt, ist
die Fehlerklasse, die den größten Teil dieses Monats gefressen hat: ein Absturz beim Abbau,
ein Akteur, der an Code übergeben wird, der ihn noch hält, eine Null-Erweiterung an einem
Hook, der früher sicher war.

Das sind genau die Fehler, die unsichtbar bleiben, bis sie katastrophal werden, die vom
Timing abhängen und die ein menschlicher Tester in einem von fünf Versuchen reproduziert.
Eine Maschine, die dasselbe Szenario über Nacht vierzigmal durchspielt, reproduziert sie
zuverlässig genug, um eine Adresse daraufzusetzen, und eine Adresse ist, wie wir immer
wieder aufschreiben, das Einzige, was einen Absturz entscheidet.

## Der Teil, der nicht offensichtlich war

Die erste Version des Bots testete sich selbst.

Nicht mit Absicht: das Harness steuerte beide Clients aus einem Prozess und teilte Zustand
zwischen ihnen, sodass ein bestandenes Szenario nur bewies, dass das Harness in sich
stimmig war. Zwei Clients, die sich einig sind, weil sie dasselbe Objekt sind, sind keine
zwei Clients.

Sie zu trennen war der größte Teil der Arbeit, und deshalb heißt der Commit, der sie
hinzufügt, *»der Bot hört auf, sich selbst zu testen«* statt etwas Schmeichelhafteres.

## Vier neue Szenarien diese Woche

Sie kamen aus der Arbeit an fallen gelassenen Gegenständen: ein geworfener und gefangener
Gegenstand, ein Gegenstand, der fallen gelassen wird, während der Werfer eine Zellgrenze
überquert, zwei Spieler, die nach demselben Objekt greifen, und ein Gegenstand, der auf
Geometrie fällt, die nur einer der beiden Clients geladen hat. Das letzte steht dort, weil
es die Form des Fehlers ist, den wir als Nächstes erwarten, und ein Test, der vor dem Fehler
geschrieben wurde, ist der einzige, der beweisen kann, dass er weg ist.
