---
title: A server anyone can join
date: 2026-10-10
summary: A public server, a page that shows who is on it and where, and the three times the map lost someone on the way.
tags: networking, website
---

Every way to play so far starts with knowing someone. One of you hosts, the other gets a code. That is
how most people will always play, and it is the right default. But it leaves out the person who has the
mod installed, a free evening, and nobody to play with.

So we are building a public server: one that is always up, that anyone can join, and a page on this site
that shows who is on it right now and where they are. It is not open yet. This is what exists, and what
it took.

## How the page knows

The server tells our hub its status: its name, its address, its build, how many players are on, and for
each player the character's name and where they stand. Every 10 seconds while anyone is connected, every
minute when nobody is, and once more, marked offline, when it is stopped properly.

It only does this on the public server. The setting is off on every other server, a friend's included,
and it needs a key that only the public server's machine and the hub hold.

The hub keeps the latest status and nothing older. If the server goes quiet for three minutes, the hub
says it is offline and drops the players from it. Nothing is kept of who played or when.

What is sent about a player is the character's name, never a Steam name, an account or an address.

## Not calling the hub too often

The hub runs on a free plan: 100,000 requests a day, for everything it does, crash reports and invite
codes included. A page that refreshes itself in every visitor's browser would spend that in an
afternoon: a hundred people watching, a request every few seconds each.

So browsers never ask the hub. They ask this website, which keeps the last answer for 5 seconds and only
goes back to the hub when a visitor's request finds its copy older than that. However many people watch,
the hub hears from us at most once every 5 seconds, and not at all when nobody is looking.

## The map lost people three times

The page draws each player as a dot on our own map of Skyrim, which moves when they move and turns to
show which way they face. Getting the dots in the right place took three tries.

**First, the cities.** In the game's data, Whiterun, Solitude, Windhelm, Riften and Markarth are each a
world of their own, separate from the rest of Skyrim. A player walking through Whiterun's gate vanished
from the map. They share Skyrim's coordinates, though, so they are now drawn on the same map.

**Then the DLC.** A player who went to Solstheim, or through the portal into the Soul Cairn, vanished the
same way. Those are real places with their own ground and their own coordinates, so each got a map of its
own: Solstheim, under snow in the north and ash in the south, and the Soul Cairn, a violet void with
islands of grey ground. The page shows them as tabs, each with how many players are there, and opens on
the busiest.

**Then the calibration.** A position from the game becomes a point on a drawing through two places whose
position is known in both. We started with estimates for Whiterun and Windhelm. When the server began
sending exact positions for Fort Dawnguard and Castle Volkihar, the estimates turned out to put the fort
80 pixels from where it is drawn, and the castle off the edge of the map entirely. Skyrim's map is now
placed from those two exact points, one in each corner. The places between them are drawn by eye, and a
reading in Whiterun's market will tell us how far off they are.

## Staying off it

Not everyone wants their character on a public page. A player who chooses to hide is left out of the list
and off the map entirely, and only counted: the page says "5 players", and "and one more, not listed".

## Status

Built: the server's status, the hub's side, and the page with its three maps, the live dots, the list of
players and a button that opens the launcher to join.

Not yet: the server itself is not open. Before it is, the server needs its key, Solstheim's map needs a
reading at two places and the Soul Cairn's at one, and the rules need writing. Place names in the list
arrive with the next build of the mod. The option to hide and the one-click Join come with the launcher
release that opens the server.

When it opens, it will be in this site's menu, and here.
