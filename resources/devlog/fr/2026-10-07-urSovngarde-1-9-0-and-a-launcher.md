---
title: La 1.9.0, sous son propre nom, et un lanceur
date: 2026-10-07
summary: La première release qui s’appelle urSovngarde, et un lanceur pour que plus personne n’ait à modifier connect.txt.
tags: sortie, lanceur
---

La 1.9.0 est sortie, et c’est la première release sous le nom urSovngarde : un seul téléchargement
complet, une seule mise à jour, un seul serveur.

## Mettre à jour n’est plus une décision de groupe

Jusqu’ici, un client et un serveur ne se parlaient que si leurs numéros de version correspondaient
exactement. Un correctif d’une ligne obligeait tout le groupe à mettre à jour le même soir, sinon
personne ne pouvait jouer.

Désormais, le serveur compare plutôt un « identifiant de protocole » : une empreinte des
définitions des messages réseau. Les builds qui échangent les mêmes messages se connectent entre
elles, quel que soit leur numéro de version. Un petit correctif n’oblige plus tout le monde à
mettre à jour le soir même. Une release qui change bel et bien les messages le dit, et alors tout
le monde met à jour, serveur compris.

## Ce qu’elle contient

- **Une suivante appartient au jeu de son joueur.** Le 3 octobre, Lydia a été confiée d’un jeu à
  l’autre 92 fois en 15 secondes, chaque jeu la reprenant à l’autre. Elle appartient désormais au
  jeu du joueur qu’elle suit.
- **Un cadavre repose au même endroit dans les deux mondes.** Avant, les deux corps pouvaient
  finir à un millier d’unités l’un de l’autre, ce qui fait loin pour chercher quelque chose que
  vous venez de tuer.
- **Traîner des corps,** vu par les deux joueurs.
- **Des lames qui se rencontrent,** senties et entendues par les deux, et la règle du défenseur
  pour savoir si un coup a été paré. Celle-là a son propre billet.
- **Des corps au bon endroit,** mains comprises, et plus d’étirement.
- **Des crash dumps légers.** Lors d’un plantage, un petit dump (bien moins de 4 Mo) est écrit en
  premier, assez petit pour accompagner un rapport.
- **Les dragons.** Un dragon en vol dans un jeu n’est plus récupéré par l’autre jeu avant
  d’atterrir. Celui-là est dans la build mais n’a pas encore été observé lors d’une vraie session.

## Un lanceur

Installer un mod multijoueur dans une liste de mods VR, c’était jusqu’ici une page d’instructions
et un fichier texte nommé connect.txt. Le lanceur remplace l’essentiel de tout ça. Sous Windows,
il :

- trouve Skyrim VR et votre gestionnaire de mods (Mod Organizer 2, liste comme FUS comprise,
  Vortex, ou aucun) ;
- installe et met à jour le mod à partir de la release la plus récente ;
- vérifie votre installation, et pour chaque problème affiche la correction et un lien de
  téléchargement ;
- lance le jeu ;
- héberge avec un code d’invitation de six lettres, et rejoint avec un code ;
- montre lesquels de vos amis Steam hébergent ;
- demande avant d’envoyer un rapport de plantage, à chaque fois, sauf si vous lui dites autrement ;
- se met à jour lui-même.

Vous le téléchargez sur ce site. Il est nouveau, et cette liste est tout ce qu’il fait. S’il dit
avoir vérifié quelque chose, il a vérifié cette chose, et rien de plus.
