---
title: Reading a crash without a debugger
date: 2026-09-28
summary: The launcher replaces the game executable, so a crash dump shows one 90 MB module with the game's code and ours inside it. Here is how we tell them apart.
tags: crashes, tooling
---

When Skyrim Together VR crashes, the dump is unhelpful in a very specific way: it shows
**one** module, about 90 MB, named `SkyrimTogetherVR.exe`. The game's code and ours are both
inside it. Module names cannot separate them, because as far as Windows is concerned there is
only one.

We spent several hours on 27 September trying to make `dbghelp` load the PDB for that image.
It will not. `SymLoadModuleEx` reports the module deferred, and then reports every known
function as not found. That is not worth trying again, and this entry exists partly so that
the next person, probably one of us, in two months, does not.

## What does work: the linker map

`Code/immersive_launcher/xmake.lua` passes `/MAP`, which produces
`build/windows/x64/release/SkyrimTogetherVR.map`. The map lists **only our symbols**. So an
address the map names is ours, and the game's whole image sits inside one symbol called
`?game_seg@@3PAEA`.

That one fact is the entire basis of the crash tooling. Three tools came out of it, cheapest
first:

**`explain-crash.py`** reads the register dump the client writes into `tp_client.log` and
names the functions. No dump file needed, just the log and the matching exe and PDB.

**`explain-dump.py`** reads an actual `.dmp`. It prints the exception, the registers, which
function `Rip` was in, and then the `RecentDeletes` ring: the last 32 remote copies this
client deleted, what still held a claim on each one, and whether any register currently holds
one of them.

A `MATCH` line means the faulting code was holding an actor we had deleted, and the teardown
path is the cause. `NO MATCH` means it was not, and the search moves elsewhere. That one
distinction is the point of the whole tool.

**`minidump.py`** is the layer underneath, for when the question is simply "is any of this
ours at all".

## The trap in the middle of it

The map has to come from the build that crashed.

A stale map does not fail. It names the wrong functions, reads the wrong addresses, and looks
entirely plausible doing it. Run a current map against a dump from 13 September and it will
confidently report "0 actor deletions recorded this session", for a build written two weeks
before `RecentDeletes` existed.

`explain-dump.py` now compares the map's timestamp against the dump's module timestamp and
refuses rather than guessing. If you use `minidump.py` or `mapsym.py` directly, that check is
yours to make.

## And one thing that is simply not possible

The game executable on disk is Steam-encrypted. An address inside `?game_seg@@3PAEA` cannot be
disassembled offline. Naming an unknown game-side caller needs either an in-game hook or the
address database. There is no third option, and an afternoon spent looking for one is an
afternoon.
