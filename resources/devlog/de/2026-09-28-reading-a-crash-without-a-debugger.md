---
title: Einen Absturz ohne Debugger lesen
date: 2026-09-28
summary: Der Launcher ersetzt die Programmdatei des Spiels, also zeigt ein Crashdump ein einziges 90-MB-Modul mit dem Code des Spiels und unserem darin. So unterscheiden wir sie.
tags: abstürze, werkzeuge
---

Wenn urSovngarde abstürzt, ist der Dump auf eine sehr bestimmte Weise nutzlos: er
zeigt **ein** Modul, etwa 90 MB groß, namens `SkyrimTogetherVR.exe`. Der Code des Spiels
und unserer stecken beide darin. Modulnamen können sie nicht trennen, denn für Windows gibt
es nur eines.

Wir haben am 27. September mehrere Stunden darauf verwendet, `dbghelp` dazu zu bringen, das
PDB für dieses Image zu laden. Es tut es nicht. `SymLoadModuleEx` meldet das Modul als
zurückgestellt und erklärt anschließend jede bekannte Funktion für nicht gefunden. Das ist
keinen zweiten Versuch wert, und dieser Eintrag existiert auch deshalb, damit die nächste
Person, vermutlich eine*r von uns, in zwei Monaten, es nicht doch tut.

## Was funktioniert: die Linker-Map

`Code/immersive_launcher/xmake.lua` übergibt `/MAP`, was
`build/windows/x64/release/SkyrimTogetherVR.map` erzeugt. Die Map listet **nur unsere
Symbole**. Eine Adresse, die sie benennt, gehört uns, und das gesamte Image des Spiels sitzt
in einem einzigen Symbol namens `?game_seg@@3PAEA`.

Diese eine Tatsache ist die gesamte Grundlage der Crash-Werkzeuge. Drei sind daraus
entstanden, vom billigsten zum aufwendigsten:

**`explain-crash.py`** liest den Registerauszug, den der Client in `tp_client.log` schreibt,
und benennt die Funktionen. Keine Dump-Datei nötig, nur das Log sowie die passende EXE und
das passende PDB.

**`explain-dump.py`** liest eine echte `.dmp`. Es gibt die Exception aus, die Register, in
welcher Funktion `Rip` stand, und dann den `RecentDeletes`-Ring: die letzten 32 entfernten
Kopien, die dieser Client gelöscht hat, was auf jede davon noch einen Anspruch hielt, und ob
gerade ein Register eine davon enthält.

Eine `MATCH`-Zeile heißt, der fehlerhafte Code hielt einen Akteur, den wir gelöscht hatten,
und der Abbaupfad ist die Ursache. `NO MATCH` heißt, er tat es nicht, und die Suche zieht
weiter. Genau diese Unterscheidung ist der Zweck des ganzen Werkzeugs.

**`minidump.py`** ist die Schicht darunter, für den Fall, dass die Frage schlicht lautet:
»Ist hier überhaupt etwas von uns dabei?«

## Die Falle in der Mitte

Die Map muss aus der Build stammen, die abgestürzt ist.

Eine veraltete Map schlägt nicht fehl. Sie benennt die falschen Funktionen, liest die
falschen Adressen und wirkt dabei vollkommen plausibel. Lass eine aktuelle Map gegen einen
Dump vom 13. September laufen, und sie meldet selbstbewusst »0 Akteur-Löschungen in dieser
Sitzung aufgezeichnet«, für eine Build, die zwei Wochen vor der Existenz von
`RecentDeletes` geschrieben wurde.

`explain-dump.py` vergleicht inzwischen den Zeitstempel der Map mit dem des Moduls im Dump
und verweigert den Dienst, statt zu raten. Wer `minidump.py` oder `mapsym.py` direkt
benutzt, muss diese Prüfung selbst machen.

## Und eine Sache, die schlicht unmöglich ist

Die Programmdatei des Spiels auf der Platte ist Steam-verschlüsselt. Eine Adresse innerhalb
von `?game_seg@@3PAEA` lässt sich offline nicht disassemblieren. Einen unbekannten Aufrufer
auf Spielseite zu benennen erfordert entweder einen Hook im laufenden Spiel oder die
Adressdatenbank. Eine dritte Möglichkeit gibt es nicht, und ein Nachmittag auf der Suche
danach ist ein Nachmittag.
