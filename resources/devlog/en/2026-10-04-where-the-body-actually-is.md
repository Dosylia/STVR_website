---
title: Where the body actually is
date: 2026-10-04
summary: Your friend's body now stands where their VRIK body stands, hands included, and nobody gets stretched anymore.
tags: vr, sync
---

Last week hips started crossing the wire, and a body began to bend where its owner bends. That
fixed the shape of your friend. It did not fix where your friend was.

The copy of the other player used to stand roughly where they stood. Roughly is fine in flat
Skyrim, where a body a few centimetres off is invisible. In a headset it is the difference between
your friend standing next to you and your friend standing slightly inside a table.

## Standing in the right place

Now the copy stands where their VRIK body stands. Not where the game thinks a character of that
size would be, but where the body their headset built actually is.

The hands go one step further. The copy's arm is bent until its hand reaches the place the owner's
hand really is. So when your friend reaches for a door handle, the hand you see arrives at the
door handle, not near it.

## The stretching

For a while, some bodies came out stretched. An arm too long, a leg trailing behind, and a shape
that looked less like a person and more like a person seen through warped glass.

The cause was one line in the wrong place. Moving a body to where it belongs is a single offset for
the whole body. We were applying it once per bone. Each bone added its share on top of its parent's,
so the far end of a limb travelled further than the near end, and the further from the root, the
worse it got. Applied once per body, the stretching went away.

## Holding things properly

A held weapon now sits in the hand the way its owner holds it. Before, it hung where the skeleton's
default would put it, which in VR is almost never where anyone holds a sword. You hold a sword where
you hold it, and now your friend sees that.

## A follower who stays

A follower now keeps her gear and comes back at once after a loading screen. Before, she was handed
to the other player's game and then back again, and arrived late and sometimes undressed. More on
followers in the release notes for 1.9.0.

## One crash fewer

For a moment after a cell changes, a copy of an actor can be left behind: a ghost. Unloading that
ghost handed a deleted actor to code that was still holding it, which is a crash with a very short
fuse. It no longer does.
