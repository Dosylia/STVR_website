---
title: 1.9.0, unter eigenem Namen, und ein Launcher
date: 2026-10-07
summary: Die erste Veröffentlichung, die urSovngarde heißt, und ein Launcher, damit niemand mehr connect.txt bearbeiten muss.
tags: veröffentlichung, launcher
---

1.9.0 ist da, und es ist die erste Veröffentlichung unter dem Namen urSovngarde: ein
vollständiger Download, ein Update, ein Server.

## Aktualisieren muss keine Gruppenentscheidung mehr sein

Bisher haben ein Client und ein Server nur miteinander gesprochen, wenn ihre Versionsnummern
genau übereinstimmten. Eine Korrektur von einer Zeile hieß, dass die ganze Gruppe am selben
Abend aktualisieren musste, oder niemand konnte spielen.

Jetzt vergleicht der Server stattdessen eine »Protokoll-ID«: eine Prüfsumme über die
Definitionen der Netzwerknachrichten. Builds, die dieselben Nachrichten austauschen,
verbinden sich miteinander, egal welche Versionsnummer sie tragen. Eine kleine Korrektur
heißt nicht mehr, dass an dem Abend alle aktualisieren. Eine Veröffentlichung, die die
Nachrichten wirklich ändert, sagt das, und dann aktualisieren alle, der Server eingeschlossen.

## Was drin ist

- **Eine Begleiterin gehört zum Spiel ihres Spielers.** Am 3. Oktober wurde Lydia in 15
  Sekunden 92 Mal zwischen den beiden Spielen hin und her gereicht, weil jedes Spiel sie sich
  vom anderen zurückholte. Jetzt gehört sie zum Spiel des Spielers, dem sie folgt.
- **Eine Leiche liegt in beiden Welten am selben Ort.** Vorher konnten die beiden Körper rund
  tausend Einheiten auseinanderliegen, und das ist ein weiter Weg, um etwas zu suchen, das du
  gerade getötet hast.
- **Leichen ziehen,** für beide Spieler sichtbar.
- **Klingen, die sich treffen,** von beiden gespürt und gehört, und die Regel des Verteidigers
  dafür, ob ein Treffer pariert wurde. Die hat einen eigenen Eintrag.
- **Körper am richtigen Ort,** die Hände eingeschlossen, und kein Strecken mehr.
- **Kleine Crashdumps.** Bei einem Absturz wird zuerst ein kleiner Dump geschrieben (deutlich
  unter 4 MB), klein genug, um ihn mit einem Bericht zu senden.
- **Drachen.** Ein Drache, der in einem Spiel fliegt, wird nicht mehr vom anderen Spiel
  übernommen, bevor er landet. Das ist in der Build, wurde aber noch in keiner echten Sitzung
  beobachtet.

## Ein Launcher

Eine Mehrspieler-Mod in eine VR-Modliste zu installieren hieß bisher: eine Seite Anleitung
und eine Textdatei namens connect.txt. Der Launcher ersetzt das meiste davon. Unter Windows:

- findet er Skyrim VR und deinen Mod-Manager (Mod Organizer 2, auch in einer Liste wie FUS,
  Vortex oder keinen);
- installiert und aktualisiert er die Mod aus der neuesten Veröffentlichung;
- prüft er deine Einrichtung und zeigt zu jedem Problem die Lösung und einen Download-Link;
- startet er das Spiel;
- hostet er mit einem Einladungscode aus sechs Buchstaben und tritt mit einem bei;
- zeigt er dir, welche deiner Steam-Freunde gerade hosten;
- fragt er jedes Mal, bevor er einen Absturzbericht sendet, solange du ihm nichts anderes sagst;
- aktualisiert er sich selbst.

Du lädst ihn von dieser Seite herunter. Er ist neu, und diese Liste ist alles, was er tut.
Sagt er, er habe etwas geprüft, dann hat er genau das geprüft, und nichts darüber hinaus.
