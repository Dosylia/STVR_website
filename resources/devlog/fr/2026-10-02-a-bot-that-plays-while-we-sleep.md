---
title: Un bot qui joue pendant qu’on dort
date: 2026-10-02
summary: Trouver une régression un vendredi soir, avec un ami dans le casque, est la façon la plus coûteuse de trouver une régression.
tags: tests, outillage
---

Pendant l’essentiel de ce projet, la suite de tests a été deux personnes dans des casques,
un vendredi soir.

Cela a de vrais avantages : on trouve ce qui compte, parce que les seuls bugs rapportés sont
ceux qui ont gâché quelque chose. Cela a aussi un défaut évident : la boucle de retour dure
une semaine, elle coûte une soirée à deux personnes, et environ la moitié de l’information
arrive sous la forme « ça a déraillé vers le camp de bandits ».

Il y a donc maintenant un bot. Il lance le client sans affichage, se connecte à un serveur,
et joue une série de paires scriptées — deux clients, un scénario chacun, un état final
attendu connu.

## Ce qu’il attrape vraiment

Pas le gameplay. Le bot n’a aucune opinion sur la qualité des combats. Ce qu’il attrape,
c’est la catégorie de bug qui a dévoré l’essentiel de ce mois : un crash à la destruction,
un acteur confié à du code qui le détient encore, une extension nulle sur un hook autrefois
sûr.

Ce sont exactement les bugs invisibles jusqu’à devenir catastrophiques, qui dépendent du
timing, et qu’un testeur humain reproduit une fois sur cinq. Une machine qui rejoue le même
scénario quarante fois dans la nuit les reproduit assez fiablement pour leur mettre une
adresse dessus — et une adresse, comme nous n’arrêtons pas de l’écrire, est la seule chose
qui tranche un crash.

## La partie qui n’était pas évidente

La première version du bot se testait elle-même.

Pas volontairement : le harnais pilotait les deux clients depuis un seul processus et
partageait l’état entre eux, si bien qu’un scénario réussi ne prouvait que la cohérence
interne du harnais. Deux clients qui s’accordent parce qu’ils sont le même objet ne font pas
deux clients.

Les séparer a représenté l’essentiel du travail, et c’est pourquoi le commit qui les ajoute
dit *« le bot cesse de se tester lui-même »* plutôt que quelque chose de plus flatteur.

## Quatre nouveaux scénarios cette semaine

Ils sont nés du travail sur les objets lâchés : un objet lancé puis rattrapé, un objet lâché
pendant que le lanceur franchit une limite de cellule, deux joueurs qui attrapent le même
objet, et un objet lâché sur une géométrie qu’un seul des deux clients a chargée. Le dernier
est là parce que c’est la forme du prochain bug que nous attendons, et un test écrit avant le
bug est le seul capable de prouver qu’il a disparu.
