---
title: 1.9.0, under its own name, and a launcher
date: 2026-10-07
summary: The first release called urSovngarde, and a launcher so that nobody has to edit connect.txt again.
tags: release, launcher
---

1.9.0 is out, and it is the first release under the name urSovngarde: one full download, one
update, one server.

## Updating no longer has to be a group decision

Until now, a client and a server would only talk if their version numbers matched exactly. A
one-line fix meant everyone in the group had to update the same evening, or nobody could play.

Now the server compares a "protocol id" instead: a digest of the network message definitions.
Builds that exchange the same messages connect to each other, whatever their version number. A
small fix no longer means everyone updates that evening. A release that does change the messages
says so, and then everyone updates, the server included.

## What is in it

- **A follower belongs to her player's game.** On 3 October, Lydia was handed between the two games
  92 times in 15 seconds, each game taking her back from the other. Now she belongs to the game of
  the player she follows.
- **A corpse lies in the same place in both worlds.** Before, the two bodies could end up about a
  thousand units apart, which is a long way to look for something you just killed.
- **Dragging bodies,** seen by both players.
- **Blades that meet,** felt and heard by both, and the defender's rule for whether a hit was
  parried. That one has its own entry.
- **Bodies in the right place,** hands included, and no more stretching.
- **Small crash dumps.** On a crash, a small dump (well under 4 MB) is written first, small enough
  to send with a report.
- **Dragons.** A dragon flying in one game is no longer taken over by the other game until it lands.
  That one is in the build but has not been seen in a real session yet.

## A launcher

Installing a multiplayer mod into a VR modlist has been, so far, a page of instructions and a text
file called connect.txt. The launcher replaces most of that. On Windows, it:

- finds Skyrim VR and your mod manager (Mod Organizer 2, a list like FUS included, Vortex, or none);
- installs and updates the mod from the newest release;
- checks your setup, and for each problem shows the fix and a download link;
- starts the game;
- hosts with a six-letter invite code, and joins with one;
- shows your Steam friends who are hosting;
- asks before it sends a crash report, every time, unless you tell it otherwise;
- updates itself.

You download it from this site. It is new, and that list is everything it does. If it says it
checked something, it checked that thing, and nothing more.
