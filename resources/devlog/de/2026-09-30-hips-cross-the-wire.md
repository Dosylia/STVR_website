---
title: Die Hüfte geht über die Leitung
date: 2026-09-30
summary: VRIK gibt dir einen Körper. Bis diese Woche konnte dein Freund das meiste davon nicht sich bewegen sehen. Drei Gelenke später schon.
tags: vr, synchronisation
---

Skyrim Together Reborn wurde für ein Spiel geschrieben, in dem der Spieler eine Kamera mit
einer angehängten Waffe ist. Alles, was ein entfernter Spieler tut, lässt sich aus einer
Position, einer Blickrichtung und einem Animationsnamen rekonstruieren, denn im flachen
Skyrim ist das tatsächlich alles, was es gibt.

VR ist das nicht. In VR ist der Spieler ein Kopf und zwei Hände, die sich unabhängig
voneinander durch einen Raum bewegen, und VRIK baut einen plausiblen Körper darum herum.
Schick nur Position und Blickrichtung, und dein Freund bekommt eine Schaufensterpuppe, die
nach vorn gewandt über den Boden gleitet, während ihr Besitzer in Wahrheit hinter einem
Felsen kauert, nach oben schaut und einen Arm ausgestreckt hat.

## Drei Gelenke, nicht dreißig

Die Versuchung ist, das ganze Skelett zu schicken. Werden wir nicht, und nicht nur wegen
der Bandbreite. Ein vollständiges Skelett bedeutet, dass sich die Gegenseite über
Knochenbenennung, Rig-Maßstab und VRIKs eigene Solver-Einstellungen einig sein muss — und
die häufigste Ursache von »er sieht einen Bären, ich sehe einen Wolf« sind bereits zwei
Modlisten, die sich uneinig sind. Einen Vertrag über dreißig Knochen dazwischenzulegen hieße,
dieselbe Fehlerklasse ausgerechnet in das eine System einzuladen, das verlässlich sein muss.

Also: Kopf, Hände, Hüfte. VRIK weiß bereits, wie man aus Kopf und Händen einen Körper baut
— das ist buchstäblich seine Aufgabe — und die Hüfte ist das, was es nicht erschließen kann.
Wo deine Hüfte ist, entscheidet darüber, ob du stehst, kauerst, dich lehnst oder in der
Taille gedreht bist, während du in die andere Richtung schaust.

Mit der Hüfte über der Leitung fingen drei Dinge gleichzeitig an zu funktionieren, die wir
als getrennte Probleme behandelt hatten:

- Sich um eine Ecke zu lehnen **sieht aus** wie sich um eine Ecke lehnen.
- Kauern liest sich als Kauern und nicht als eine kleinere Person.
- Sich umzudrehen, um nach hinten zu sehen, dreht nicht mehr den ganzen Körper mit dem Kopf
  — das war das mit Abstand Unheimlichste im Spiel, und wir nannten es »die Eule«.

## Was es gekostet hat

Ein Commit dieser Arbeit heißt *Die Hüfte erreicht den Körper*, was genug darüber sagt, wie
der erste Versuch lief. Die Hüftposition kam im falschen Raum an — richtige Zahlen, falscher
Ursprung —, also standen entfernte Spieler mit dem Becken etwa einen Meter vor der Brust.
Das wirkte weniger wie ein Fehler und mehr wie ein Fluch.

## Weiterhin offen

Als Nächstes kommen Gesten, und das ist ein anderes Problem. Über die Schulter greifen, an
der Hüfte einstecken, etwas aus der Luft fangen: das sind VRIK-*Interaktionen*, und im
Moment sieht dein Freund die nächstbeste Standardanimation statt dem, was du getan hast. Das
ist Ziel drei auf dem Fahrplan, und es ist dasjenige, das darüber entscheidet, ob sich das
hier wie VR-Mehrspieler anfühlt oder wie Mehrspieler-Skyrim mit einem Headset auf.
