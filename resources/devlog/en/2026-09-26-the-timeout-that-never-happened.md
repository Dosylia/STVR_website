---
title: The timeout that never happened
date: 2026-09-26
summary: A whole night's fixes were built on a reading of a log that turned out to be wrong. The fixes stand; the story behind them does not.
tags: crashes, diagnosis
---

On the night of the 25th we read a friend's log bundle and concluded that his client had
dropped five times mid-session, and that the churn from those drops was what broke the world
around him. We wrote fixes against that. The fixes are good. The reading was wrong.

Here is what the reason codes actually mean, read out of `TiltedConnect/Client.cpp` rather
than assumed:

- **`0 kTimeout`** is only ever reported when the previous state was `Connecting`. It is a
  connection attempt that never completed — not a live connection dropping. His two at
  21:16:01 and 21:16:16 were failed attempts to connect after loading a save.
- **`4 kAborted`** comes from `Client::Close()`. That is *this* client closing the connection
  itself. All three of his were deliberate local closes.

So there were no mid-session timeouts at all. Not fewer than we thought — none.

## The forty-five actors were not a fault either

The other half of that night's theory was a moment at 21:19:01 where the client handed back
45 actors at once, which looked like exactly the kind of avalanche that would leave the world
in pieces.

His grid changes over those three minutes run (5,7) → (6,7) → (7,7) → (8,6) → (9,6) →
(10,7) → (11,7). That is about 25,000 units across Solstheim in three minutes. The game
unloaded the cells behind him, and the client relinquished what was in them.

That is not a bug. That is the thing working.

It also explains a report we had filed separately. **Lydia was four cells behind him** — at
x≈29000 while he stood at x≈47000 — which is the entire content of "Seen does not see Lydia
at all" at 21:21. She was not missing. She was in Raven Rock.

## What is left

Three things from that session are still genuinely unexplained:

1. A bandit launched into the sky at 21:19.
2. A dead body in the wrong place at 21:20.
3. A spriggan whose hits never land, at 21:25.

All three happened while he was crossing cells fast. That is now the thread we are pulling,
instead of the timeout theory that was never there.

## The lesson, which we keep relearning

The `Silence:` diagnostic line we added on the 25th is staying. A client that stops talking is
still worth knowing about, and it costs nothing. But its justification has changed from "this
is the bug" to "this is interesting", and that is a demotion worth writing down.

Three times on 27 September a crash was blamed on something different — weapon-touch caching,
then a bounds read, then the friend's hardware — each one inferred from a crash happening
shortly after a batch of copies was torn down. All three were plausible. None was checked
against an address.

Timing suggests. Addresses settle.
