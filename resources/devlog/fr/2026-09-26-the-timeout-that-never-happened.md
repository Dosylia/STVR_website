---
title: Le timeout qui n’a jamais eu lieu
date: 2026-09-26
summary: Toute une nuit de correctifs reposait sur une lecture de log qui s’est révélée fausse. Les correctifs tiennent ; l’histoire derrière eux, non.
tags: crashs, diagnostic
---

Dans la nuit du 25, nous avons lu le bundle de logs d’un ami et conclu que son client
avait décroché cinq fois en pleine session, et que la pagaille provoquée par ces
déconnexions était ce qui cassait le monde autour de lui. Nous avons écrit des correctifs
contre ça. Les correctifs sont bons. La lecture était fausse.

Voici ce que les codes de raison veulent vraiment dire, lus dans `TiltedConnect/Client.cpp`
plutôt que supposés :

- **`0 kTimeout`** n’est signalé que lorsque l’état précédent était `Connecting`. C’est une
  tentative de connexion qui n’a jamais abouti — pas une connexion vivante qui tombe. Ses
  deux occurrences à 21:16:01 et 21:16:16 sont des tentatives échouées après le chargement
  d’une sauvegarde.
- **`4 kAborted`** vient de `Client::Close()`. C’est *ce* client qui ferme lui-même la
  connexion. Ses trois occurrences étaient des fermetures locales délibérées.

Il n’y a donc eu aucun timeout en cours de session. Pas moins que ce que nous pensions —
aucun.

## Les quarante-cinq acteurs n’étaient pas une anomalie non plus

L’autre moitié de la théorie de cette nuit-là était un moment, à 21:19:01, où le client a
rendu 45 acteurs d’un coup, ce qui ressemblait exactement au genre d’avalanche capable de
laisser un monde en morceaux.

Ses changements de grille sur ces trois minutes donnent (5,7) → (6,7) → (7,7) → (8,6) →
(9,6) → (10,7) → (11,7). Cela représente environ 25 000 unités à travers Solstheim en trois
minutes. Le jeu a déchargé les cellules derrière lui, et le client a relâché ce qui s’y
trouvait.

Ce n’est pas un bug. C’est la chose qui fonctionne.

Cela explique aussi un rapport que nous avions classé à part. **Lydia était quatre cellules
derrière lui** — à x≈29000 alors qu’il se tenait à x≈47000 — ce qui constitue l’intégralité
du « Seen ne voit pas Lydia du tout » de 21:21. Elle n’avait pas disparu. Elle était à
Raven Rock.

## Ce qui reste

Trois choses de cette session restent réellement inexpliquées :

1. Un bandit propulsé dans le ciel à 21:19.
2. Un cadavre au mauvais endroit à 21:20.
3. Une spriggan dont les coups ne portent jamais, à 21:25.

Les trois se sont produites pendant qu’il traversait les cellules à toute vitesse. C’est ce
fil que nous tirons désormais, à la place d’une théorie du timeout qui n’a jamais existé.

## La leçon, que nous réapprenons sans cesse

La ligne de diagnostic `Silence:` ajoutée le 25 reste. Un client qui cesse de parler mérite
toujours d’être repéré, et cela ne coûte rien. Mais sa justification est passée de « c’est
le bug » à « c’est intéressant », et cette rétrogradation mérite d’être écrite.

Trois fois le 27 septembre, un crash a été imputé à autre chose — la mise en cache du
contact d’arme, puis une lecture hors bornes, puis le matériel de l’ami — chaque fois
déduit d’un crash survenu peu après la destruction d’un lot de copies. Les trois étaient
plausibles. Aucune n’avait été vérifiée contre une adresse.

Le timing suggère. Les adresses tranchent.
