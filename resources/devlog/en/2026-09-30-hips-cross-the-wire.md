---
title: Hips cross the wire
date: 2026-09-30
summary: VRIK gives you a body. Until this week your friend could not see most of it move. Three joints later, they can.
tags: vr, sync
---

Skyrim Together Reborn was written for a game where the player is a camera with a weapon
attached. Everything a remote player does can be reconstructed from a position, a facing, and
an animation name, because in flat Skyrim that genuinely is all there is.

VR is not that. In VR the player is a head and two hands moving independently in a room, and
VRIK builds a plausible body around them. Send only position and facing and your friend gets
a mannequin that slides along the ground facing forward while its owner is actually crouched
behind a rock, looking up, with one arm out.

## Three joints, not thirty

The temptation is to send the whole skeleton. We are not going to, and not only for bandwidth.
A full skeleton means the remote end has to agree about bone naming, rig scale and VRIK's own
solver settings — and the number one cause of "he sees a bear, I see a wolf" is already two
modlists disagreeing. Adding a thirty-bone contract between them would be inviting the same
class of bug into the one system that has to be reliable.

So: head, hands, hips. VRIK already knows how to build a body out of head and hands — that is
literally its job — and the hips are what it cannot infer. Where your hips are decides whether
you are standing, crouched, leaning, or turned at the waist while looking the other way.

With hips crossing the wire, three things started working at once that we had been treating as
separate problems:

- Leaning around a corner **looks like** leaning around a corner.
- Crouching reads as crouching rather than as a shorter person.
- Turning to look behind you no longer rotates your whole body with your head, which was the
  single most uncanny thing in the game and which we had been calling "the owl".

## What it cost

One commit of this work is called *Hips reach the body*, which should tell you how the first
attempt went. The hip position arrived in the wrong space — correct numbers, wrong origin —
so remote players stood with their pelvis about a metre in front of their chest. It looked
less like a bug and more like a curse.

## Still open

Gestures are next, and they are a different problem. Reaching over your shoulder, holstering at
your hip, grabbing something out of the air: those are VRIK *interactions*, and right now your
friend sees the nearest matching stock animation rather than the thing you did. That is goal
three on the roadmap, and it is the one that will decide whether this feels like multiplayer VR
or like multiplayer Skyrim with a headset on.
