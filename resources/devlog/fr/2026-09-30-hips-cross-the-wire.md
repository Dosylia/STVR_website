---
title: Le bassin traverse le réseau
date: 2026-09-30
summary: VRIK vous donne un corps. Jusqu’à cette semaine, votre ami n’en voyait pas bouger grand-chose. Trois articulations plus tard, si.
tags: vr, synchronisation
---

Skyrim Together Reborn a été écrit pour un jeu où le joueur est une caméra avec une arme
attachée. Tout ce que fait un joueur distant peut se reconstruire à partir d’une position,
d’une orientation et d’un nom d’animation, parce que dans le Skyrim plat c’est réellement
tout ce qu’il y a.

La VR, non. En VR le joueur est une tête et deux mains qui bougent indépendamment dans une
pièce, et VRIK construit un corps plausible autour. N’envoyez que la position et
l’orientation, et votre ami obtient un mannequin qui glisse au sol, face en avant, pendant
que son propriétaire est en réalité accroupi derrière un rocher, les yeux levés, un bras
tendu.

## Trois articulations, pas trente

La tentation est d’envoyer tout le squelette. Nous n’allons pas le faire, et pas seulement
pour la bande passante. Un squelette complet signifie que l’autre bout doit être d’accord
sur le nommage des os, l’échelle du rig et les réglages du solveur de VRIK, et la première
cause de « il voit un ours, je vois un loup » est déjà deux listes de mods en désaccord.
Ajouter un contrat de trente os entre elles reviendrait à inviter la même classe de bug dans
le seul système qui doit être fiable.

Donc : tête, mains, bassin. VRIK sait déjà construire un corps à partir d’une tête et de
deux mains, ce qui est littéralement son travail, et le bassin est ce qu’il ne peut pas
déduire. La position de votre bassin décide si vous êtes debout, accroupi, penché, ou tourné
à la taille tout en regardant ailleurs.

Avec le bassin qui traverse le réseau, trois choses se sont mises à fonctionner d’un coup,
alors que nous les traitions comme des problèmes séparés :

- Se pencher au coin d’un mur **ressemble** à se pencher au coin d’un mur.
- S’accroupir se lit comme s’accroupir, et non comme quelqu’un de plus petit.
- Se retourner pour regarder derrière soi ne fait plus pivoter tout le corps avec la tête,
  ce qui était la chose la plus troublante du jeu et que nous appelions « le hibou ».

## Ce que ça a coûté

Un des commits de ce travail s’appelle *Le bassin rejoint le corps*, ce qui devrait vous
dire comment s’est passée la première tentative. La position du bassin arrivait dans le
mauvais espace (bons chiffres, mauvaise origine), et les joueurs distants se tenaient donc
avec le bassin un mètre devant la poitrine. Cela ressemblait moins à un bug qu’à une
malédiction.

## Toujours ouvert

Les gestes viennent ensuite, et c’est un autre problème. Attraper par-dessus l’épaule,
rengainer à la hanche, saisir quelque chose en l’air : ce sont des *interactions* VRIK, et
pour l’instant votre ami voit l’animation standard la plus proche plutôt que ce que vous
avez fait. C’est l’objectif trois de la feuille de route, et c’est celui qui décidera si
tout ceci donne l’impression d’un multijoueur VR ou d’un Skyrim multijoueur avec un casque
sur la tête.
