---
title: Three ways a hit got through
date: 2026-10-09
summary: Two fights, two sets of logs, and three different reasons a parried blow still hurt.
tags: vr, combat
---

The defender's rule worked in some fights and not in others. That is the worst kind of result,
because it means the rule is probably right and something around it is not.

Two evenings of fights between Emma and Seen, with both logs laid side by side, gave three separate
causes. None of them was the rule.

## 1. The host who joined first

A server numbers everything it knows, starting from zero. When the host's own character happened to
get number 0, none of the other player's hits on her reached the rule at all: 0 out of 30.

The next evening she got number 1, and all 11 hits did reach it. Which thing gets 0 is chance, which
is why the rule looked unreliable rather than broken.

The fix: the server never hands out 0.

## 2. Dawnbreaker

Dawnbreaker's fire enchantment is cast at every strike. The mod sent that to the other game as a
spell, and the copy in the other game cast it again.

So even a strike that was correctly dropped on the other player's blade still burned him: 13 times,
for 16 to 74 damage each. The parry worked. The fire did not care.

The fix: a weapon's strike enchantment is no longer sent as a spell. The strike is the hit.

## 3. Bare hands

The rule counted any hand touching the other blade as a parry, including a hand holding a spell. You
could stop a sword with a fireball, if your timing was good.

Emma's call: only a sword or a shield parries. Now a blade that meets an empty hand, or a hand
holding a spell, is a hit on that hand.

## Status

All three are fixed in a build being tested now, and will be in the next release.

Next, decided: blades that physically stop each other, instead of passing through with sparks.

Still open: in one game, the other player's copy sometimes holds no weapon at all, so there is
nothing to parry. That is the next thing to find.
