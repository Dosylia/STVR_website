---
title: Kein Port zu öffnen
date: 2026-10-09
summary: Hosten fing bisher mit der Einstellungsseite deines Routers an. Jetzt geht der Launcher stattdessen über ein kleines Relay von uns.
tags: netzwerk, launcher
---

Der häufigste Grund, warum zwei Freunde nicht zusammen spielen konnten, war nie die Mod. Es
war der Router des Hosts.

Einen UDP-Port zu öffnen ist für manche leicht und für andere unmöglich. Manche
Internetanbieter teilen eine öffentliche Adresse zwischen vielen Haushalten auf, und dann
gibt es überhaupt keinen Port zu öffnen, egal wie lange du auf der Einstellungsseite des
Routers verbringst.

## Was wir uns zuerst angesehen haben

Zuerst kamen die kostenlosen Möglichkeiten, denn ein Relay zu schreiben ist nicht der
spaßige Teil einer VR-Mod.

playit.gg würde funktionieren, braucht für ein Spiel, das nicht auf seiner Liste steht, aber
den kostenpflichtigen Tarif. Tailscale, ZeroTier und Radmin VPN funktionieren alle, und die
Hosting-Seite empfiehlt sie seit Wochen, aber jedes davon verlangt von jedem Spieler, erst
etwas zu installieren und einzurichten, bevor er beitreten kann.

Also haben wir unser eigenes Relay geschrieben: ein kleines Programm auf einem Server, den
wir mieten.

## Wie es funktioniert

Wenn du hostest, öffnet der Launcher einen ausgehenden UDP-Strom zum Relay und meldet eine
Sitzung an. Ausgehenden Verkehr lassen Router zu Hause ohnehin durch, also gibt es nichts zu
öffnen. Dein Einladungscode bezeichnet diese Sitzung.

Ein Freund, der mit dem Code beitritt, bekommt in seinem Launcher einen Tunnel. Das Spiel und
der Server bekommen davon nichts mit: Jeder von beiden spricht mit einem Tunnel auf dem
eigenen PC, als stünde die Gegenseite direkt daneben.

Der Datenverkehr des Spiels ist durch die eigene Netzwerktechnik des Spiels verschlüsselt,
also reicht das Relay Bytes weiter, die es nicht lesen kann.

Es ist außerdem darauf gebaut, einen Neustart zu überstehen. Ist das Relay kurz weg, merken
die Tunnel die Stille und nehmen ihre Plätze von selbst wieder ein.

## Wie schnell

Gemessen von Emmas PC aus: im Median 50 ms für einen Hin- und Rückweg, der das Relay zweimal
durchquert hat. Das sind etwa 25 ms pro Richtung ab ihrer Leitung, und 50 von 50 Paketen
kamen zurück.

## Stand

In Betrieb seit dem 9. Oktober, für Launcher 0.3.0 und neuer, auf beiden Seiten. Es ist neu:
Eine ganze Spielsitzung hat es noch nicht getragen. Kommt ein Freund nicht rein,
funktionieren Portweiterleitung und Tailscale genau wie vorher.

## Diese Woche außerdem im Launcher

Launcher 0.3.2 bringt zwei weitere Dinge:

- Ab Vortex 1.14 wird die Mod als Vortex-Mod installiert und erscheint in dessen Liste. Bei
  älterem Vortex werden die Dateien wie bisher nach Data kopiert.
- Das Warten nach dem Drücken auf Spielen ist jetzt ein Ladebildschirm, der dem echten Start
  Schritt für Schritt folgt. Lehnt dich ein Server ab, sagt er, warum; eine falsche Version
  zeigt beide Versionen.
