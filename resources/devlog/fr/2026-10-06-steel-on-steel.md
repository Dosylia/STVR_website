---
title: Acier contre acier
date: 2026-10-06
summary: Quand votre lame rencontre la sienne, vous le sentez tous les deux, vous l’entendez tous les deux, et le coup qu’elle a arrêté ne porte plus.
tags: vr, combat
---

Dans le Skyrim à plat, un combat à l’épée, ce sont deux animations qui se jouent l’une près de
l’autre. En VR, un coup est un vrai coup, votre bras qui fend l’air, donc deux lames peuvent
vraiment se rencontrer. Jusqu’à cette semaine, quand elles le faisaient, il ne se passait rien.
Elles se traversaient comme deux fantômes trop polis.

## Le sentir

Désormais, quand deux lames se rencontrent, les deux joueurs sentent une impulsion dans la main qui
tient l’arme, entendent le choc, et des étincelles jaillissent du point de contact. Ça paraît peu.
Dans un casque, c’est le moment où l’autre joueur cesse d’être un enregistrement et devient
quelqu’un qui résiste.

## Décider qui a paré

Sentir le choc, c’est la partie facile. La partie difficile, c’est de décider s’il a arrêté le
coup.

Chaque jeu voit l’autre joueur avec 225 millisecondes de retard. Ce n’est pas de la latence au
sens habituel : c’est la façon dont les mouvements de l’autre joueur sont lissés, pour que ses
bras glissent au lieu de sauter. Mais cela signifie que les deux jeux sont en désaccord, à chaque
fois, sur l’endroit où se trouvaient les deux lames à un instant donné. Votre jeu vous a vu parer.
Le sien a vu son épée arriver une fraction plus tôt.

Il faut que quelqu’un tranche, et nous avons choisi le défenseur. Ce que vous avez vu sur votre
écran, c’est ce que vous avez paré. Nous l’appelons la règle du défenseur.

## D’où vient la fenêtre

Nous n’avons pas deviné les chiffres. Le premier vrai combat entre deux casques nous a donné les
logs des deux côtés. Chaque fois que le jeu du défenseur a vu les lames se rencontrer peu avant un
coup, la rencontre précédait le coup de 120 à 290 millisecondes : six fois sur six sous les 300.

La règle est donc la suivante : un coup est annulé si, sur l’écran du défenseur, les lames se sont
rencontrées entre 300 millisecondes avant lui et 100 millisecondes après.

## État

Dans la 1.9.0. Les lames se traversent encore après s’être rencontrées, avec des étincelles. Faire
qu’elles s’arrêtent l’une l’autre est un autre chantier, et un plus gros.
