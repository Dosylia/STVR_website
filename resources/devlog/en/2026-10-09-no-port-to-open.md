---
title: No port to open
date: 2026-10-09
summary: Hosting used to start with your router's settings page. Now the launcher goes through a small relay of ours instead.
tags: networking, launcher
---

The most common reason two friends could not play together was never the mod. It was the host's
router.

Opening a UDP port is easy for some people and impossible for others. Some internet providers share
one public address between many homes, and then there is no port to open at all, however long you
spend in the router's settings page.

## What we looked at first

The free options came first, because writing a relay is not the fun part of a VR mod.

playit.gg would work, but for a game that is not on its list it needs the paid plan. Tailscale,
ZeroTier and Radmin VPN all work, and the hosting page has recommended them for weeks, but each
asks every player to install and set up something before they can join.

So we wrote our own relay: a small program on a server we rent.

## How it works

When you host, the launcher opens one outgoing UDP flow to the relay and registers a session.
Outgoing traffic is what home routers already allow, so there is nothing to open. Your invite code
names that session.

A friend who joins with the code gets a tunnel in their launcher. The game and the server never
know any of this happened: each of them talks to a tunnel on its own PC, as if the other end were
next to it.

The game's traffic is encrypted by the game's own networking, so the relay passes along bytes it
cannot read.

It is also built to survive a restart. If the relay goes away for a moment, the tunnels notice the
silence and take their places back by themselves.

## How fast

Measured from Emma's PC: a median of 50 ms for a round trip that crossed the relay twice. That is
about 25 ms each way from her line, and 50 packets out of 50 came back.

## Status

Live since 9 October, for launcher 0.3.0 and newer, on both sides. It is new: it has not carried a
full game session yet. If a friend cannot connect, port forwarding and Tailscale still work exactly
as before.

## Also in the launcher this week

Launcher 0.3.2 brings two more things:

- On Vortex 1.14 or newer, the mod is installed as a Vortex mod and shows in its list. On older
  Vortex, the files are copied into Data as before.
- The wait after pressing Play is a loading screen that follows the real start, step by step. If a
  server refuses you, it says why; a wrong version shows both versions.
