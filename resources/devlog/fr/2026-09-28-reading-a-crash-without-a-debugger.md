---
title: Lire un crash sans débogueur
date: 2026-09-28
summary: Le lanceur remplace l’exécutable du jeu, donc un crash dump ne montre qu’un seul module de 90 Mo contenant à la fois le code du jeu et le nôtre. Voici comment on les distingue.
tags: crashs, outillage
---

Quand urSovngarde plante, le dump est inutile d’une façon très précise : il montre
**un** module, environ 90 Mo, nommé `SkyrimTogetherVR.exe`. Le code du jeu et le nôtre sont
tous les deux dedans. Les noms de modules ne peuvent pas les séparer, parce que pour
Windows il n’y en a qu’un.

Nous avons passé plusieurs heures le 27 septembre à essayer de faire charger le PDB de
cette image par `dbghelp`. Il ne le fera pas. `SymLoadModuleEx` signale le module comme
différé, puis déclare introuvable chaque fonction pourtant connue. Cela ne vaut pas la
peine d’être retenté, et cette entrée existe en partie pour que la prochaine personne, probablement l’un de nous, dans deux mois, ne le fasse pas.

## Ce qui marche : la table des symboles de l’éditeur de liens

`Code/immersive_launcher/xmake.lua` passe `/MAP`, ce qui produit
`build/windows/x64/release/SkyrimTogetherVR.map`. Cette table ne liste **que nos symboles**.
Donc une adresse qu’elle nomme est à nous, et toute l’image du jeu tient dans un seul
symbole appelé `?game_seg@@3PAEA`.

Ce seul fait est la base entière de l’outillage de crash. Trois outils en sont sortis, du
moins cher au plus lourd :

**`explain-crash.py`** lit le dump de registres que le client écrit dans `tp_client.log` et
nomme les fonctions. Pas besoin de fichier dump, juste le log et l’exe et le PDB
correspondants.

**`explain-dump.py`** lit un vrai `.dmp`. Il affiche l’exception, les registres, la fonction
dans laquelle se trouvait `Rip`, puis l’anneau `RecentDeletes` : les 32 dernières copies
distantes supprimées par ce client, ce qui détenait encore une revendication sur chacune,
et si un registre en contient une actuellement.

Une ligne `MATCH` signifie que le code fautif détenait un acteur que nous avions supprimé,
et que le chemin de destruction est la cause. `NO MATCH` signifie que non, et la recherche
se déplace ailleurs. Cette seule distinction est la raison d’être de l’outil.

**`minidump.py`** est la couche en dessous, pour quand la question est simplement « est-ce
que quoi que ce soit là-dedans est à nous ».

## Le piège au milieu

La table doit venir de la build qui a planté.

Une table périmée n’échoue pas. Elle nomme les mauvaises fonctions, lit les mauvaises
adresses, et a l’air parfaitement plausible en le faisant. Lancez une table actuelle contre
un dump du 13 septembre et elle annoncera avec aplomb « 0 suppressions d’acteurs
enregistrées pour cette session », pour une build écrite deux semaines avant l’existence
de `RecentDeletes`.

`explain-dump.py` compare désormais l’horodatage de la table à celui du module dans le dump
et refuse plutôt que de deviner. Si vous utilisez `minidump.py` ou `mapsym.py` directement,
cette vérification est à votre charge.

## Et une chose simplement impossible

L’exécutable du jeu sur le disque est chiffré par Steam. Une adresse à l’intérieur de
`?game_seg@@3PAEA` ne peut pas être désassemblée hors ligne. Nommer un appelant inconnu
côté jeu demande soit un hook en jeu, soit la base d’adresses. Il n’y a pas de troisième
option, et un après-midi passé à en chercher une est un après-midi.
