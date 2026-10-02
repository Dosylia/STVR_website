---
title: Der Timeout, den es nie gab
date: 2026-09-26
summary: Eine ganze Nacht voller Korrekturen beruhte auf einer Log-Lesart, die sich als falsch herausstellte. Die Korrekturen halten; die Geschichte dahinter nicht.
tags: abstürze, diagnose
---

In der Nacht auf den 25. haben wir das Log-Bundle eines Freundes gelesen und daraus
geschlossen, dass sein Client fünfmal mitten in der Sitzung abgerissen sei, und dass das
Durcheinander aus diesen Abbrüchen die Welt um ihn herum zerlegt habe. Dagegen haben wir
Korrekturen geschrieben. Die Korrekturen sind gut. Die Lesart war falsch.

Das hier bedeuten die Reason Codes tatsächlich, nachgelesen in
`TiltedConnect/Client.cpp` statt angenommen:

- **`0 kTimeout`** wird nur gemeldet, wenn der vorherige Zustand `Connecting` war. Das ist
  ein Verbindungsversuch, der nie zustande kam — keine laufende Verbindung, die abreißt.
  Seine beiden um 21:16:01 und 21:16:16 sind fehlgeschlagene Versuche nach dem Laden eines
  Spielstands.
- **`4 kAborted`** kommt aus `Client::Close()`. Das ist *dieser* Client, der die Verbindung
  selbst schließt. Alle drei waren bewusste lokale Schließungen.

Es gab also überhaupt keine Timeouts mitten in der Sitzung. Nicht weniger als gedacht —
keine.

## Die fünfundvierzig Akteure waren auch kein Fehler

Die andere Hälfte der Theorie jener Nacht war ein Moment um 21:19:01, in dem der Client 45
Akteure auf einmal zurückgab — was genau nach der Art Lawine aussah, die eine Welt in
Stücke zurücklässt.

Seine Grid-Wechsel über diese drei Minuten lauten (5,7) → (6,7) → (7,7) → (8,6) → (9,6) →
(10,7) → (11,7). Das sind etwa 25.000 Einheiten quer über Solstheim in drei Minuten. Das
Spiel hat die Zellen hinter ihm entladen, und der Client hat freigegeben, was darin war.

Das ist kein Bug. Das ist die Sache, die funktioniert.

Es erklärt auch eine Meldung, die wir getrennt abgelegt hatten. **Lydia war vier Zellen
hinter ihm** — bei x≈29000, während er bei x≈47000 stand — und das ist der gesamte Inhalt
von »Seen sieht Lydia überhaupt nicht« um 21:21. Sie fehlte nicht. Sie war in Rabenfels.

## Was übrig bleibt

Drei Dinge aus dieser Sitzung sind weiterhin wirklich ungeklärt:

1. Ein Bandit, der um 21:19 in den Himmel geschleudert wurde.
2. Eine Leiche am falschen Ort um 21:20.
3. Eine Spriggan, deren Treffer nie landen, um 21:25.

Alle drei passierten, während er in hohem Tempo Zellen überquerte. An diesem Faden ziehen
wir jetzt, statt an einer Timeout-Theorie, die es nie gab.

## Die Lehre, die wir immer wieder neu lernen

Die am 25. ergänzte Diagnosezeile `Silence:` bleibt. Ein Client, der aufhört zu reden, ist
weiterhin wissenswert, und es kostet nichts. Aber ihre Begründung hat sich von »das ist der
Fehler« zu »das ist interessant« verschoben, und diese Herabstufung ist es wert,
aufgeschrieben zu werden.

Dreimal wurde am 27. September ein Absturz auf etwas anderes geschoben — auf das Caching
der Waffenberührung, dann auf einen Zugriff außerhalb der Grenzen, dann auf die Hardware
des Freundes — jedes Mal abgeleitet aus einem Absturz kurz nach dem Abbau eines Stapels
Kopien. Alle drei waren plausibel. Keine wurde gegen eine Adresse geprüft.

Timing legt nahe. Adressen entscheiden.
