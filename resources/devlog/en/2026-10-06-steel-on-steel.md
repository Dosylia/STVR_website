---
title: Steel on steel
date: 2026-10-06
summary: When your blade meets theirs, you both feel it, you both hear it, and the hit it stopped no longer lands.
tags: vr, combat
---

In flat Skyrim a sword fight is two animations playing near each other. In VR a swing is a real
swing, your arm through the air, so two blades really can meet. Until this week, when they did,
nothing happened. They passed through each other like two ghosts being polite.

## Feeling it

Now when blades meet, both players feel a pulse in the hand holding the weapon, both hear the
clash, and sparks fly from the point where they met. It sounds small. In a headset it is the moment
the other player stops being a recording and starts being somebody pushing back.

## Deciding who parried

Feeling the clash is the easy part. The hard part is deciding whether it stopped the hit.

Each game sees the other player 225 milliseconds late. That is not lag in the usual sense; it is
how the other player's movement is smoothed, so their arms glide instead of jumping. But it means
the two games disagree, every time, about where both blades were at any given moment. Your game
saw you block. Their game saw their sword arrive a fraction earlier.

Somebody has to decide, and we chose the defender. What you saw on your screen is what you parried.
We call it the defender's rule.

## Where the window came from

We did not guess the numbers. The first real fight between two headsets gave us logs from both
sides. Each time the defender's game saw the blades meet close to a hit, the meeting came 120 to 290
milliseconds before the hit: six times out of six within 300.

So the rule is: a hit is dropped if, on the defender's screen, the blades met anywhere from 300
milliseconds before it to 100 milliseconds after.

## Status

In 1.9.0. Blades still pass through each other after they meet, with sparks. Making them stop each
other is a different and bigger job.
