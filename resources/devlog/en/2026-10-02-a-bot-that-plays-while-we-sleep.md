---
title: A bot that plays while we sleep
date: 2026-10-02
summary: Finding a regression on a Friday night with a friend in the headset is the most expensive way to find a regression.
tags: testing, tooling
---

For most of this project, the test suite was two people in headsets on a Friday evening.

That has real advantages. It finds the things that matter, because the only bugs that get
reported are the ones that ruined something. It also has an obvious problem: the feedback loop
is a week long, it costs two people an evening, and roughly half the information arrives as
"it went weird near the bandit camp".

So there is now a bot. It runs the client headless, connects to a server, and plays through a
set of scripted pairs: two clients, a scenario each, a known expected state at the end.

## What it actually catches

Not gameplay. The bot has no opinion about whether combat feels good. What it catches is the
category of bug that has eaten most of this month: a crash on teardown, an actor handed to
code that still holds it, a null extension on a hook that used to be safe.

Those are exactly the bugs that are invisible until they are catastrophic, that depend on
timing, and that a human tester reproduces one time in five. A machine running the same
scenario forty times overnight reproduces them reliably enough to put an address on them,
and an address, as we keep writing down, is the only thing that settles a crash.

## The part that was not obvious

The first version of the bot tested itself.

Not deliberately: the harness was driving both clients from one process and sharing state
between them, so a scenario that passed proved only that the harness was internally
consistent. Two clients that agree because they are the same object are not two clients.

Separating them was most of the work, and it is why the commit that added them says
*"the bot stops testing itself"* rather than something more flattering.

## Four new scenarios this week

They came out of the dropped-item work: an item thrown and caught, an item dropped while the
thrower crosses a cell boundary, two players grabbing at the same object, and an item dropped
onto geometry that only one of the two clients has loaded. The last one is there because that
is the shape of the bug we expect to find next, and a test written before the bug is the only
kind that can prove it is gone.
