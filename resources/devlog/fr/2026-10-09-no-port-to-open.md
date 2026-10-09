---
title: Aucun port à ouvrir
date: 2026-10-09
summary: Héberger commençait par la page de réglages de votre box. Désormais, le lanceur passe plutôt par un petit relais à nous.
tags: réseau, lanceur
---

La raison la plus fréquente pour laquelle deux amis ne pouvaient pas jouer ensemble n’a jamais été
le mod. C’était la box de celui qui hébergeait.

Ouvrir un port UDP est facile pour certains et impossible pour d’autres. Certains fournisseurs
d’accès partagent une même adresse publique entre de nombreux foyers, et il n’y a alors aucun port
à ouvrir, quel que soit le temps passé dans les réglages de la box.

## Ce que nous avons regardé d’abord

Les options gratuites d’abord, parce qu’écrire un relais n’est pas la partie amusante d’un mod VR.

playit.gg fonctionnerait, mais pour un jeu qui ne figure pas sur sa liste, il faut l’offre
payante. Tailscale, ZeroTier et Radmin VPN fonctionnent tous, et la page d’hébergement les
recommande depuis des semaines, mais chacun demande à chaque joueur d’installer et de configurer
quelque chose avant de pouvoir rejoindre.

Nous avons donc écrit notre propre relais : un petit programme sur un serveur que nous louons.

## Comment ça marche

Quand vous hébergez, le lanceur ouvre un flux UDP sortant vers le relais et enregistre une
session. Le trafic sortant, les box domestiques l’autorisent déjà, donc il n’y a rien à ouvrir.
Votre code d’invitation désigne cette session.

Un ami qui rejoint avec le code obtient un tunnel dans son lanceur. Le jeu et le serveur n’en
savent jamais rien : chacun parle à un tunnel sur son propre PC, comme si l’autre bout était juste
à côté.

Le trafic du jeu est chiffré par la couche réseau du jeu lui-même, si bien que le relais fait
passer des octets qu’il ne peut pas lire.

Il est aussi conçu pour survivre à un redémarrage. Si le relais disparaît un instant, les tunnels
remarquent le silence et reprennent leur place d’eux-mêmes.

## À quelle vitesse

Mesuré depuis le PC d’Emma : une médiane de 50 ms pour un aller-retour qui traversait deux fois le
relais. Cela fait environ 25 ms dans chaque sens depuis sa ligne, et 50 paquets sur 50 sont
revenus.

## État

En service depuis le 9 octobre, pour le lanceur 0.3.0 et plus récent, des deux côtés. C’est
nouveau : il n’a pas encore porté une session de jeu complète. Si un ami n’arrive pas à se
connecter, la redirection de port et Tailscale fonctionnent toujours exactement comme avant.

## Aussi dans le lanceur cette semaine

Le lanceur 0.3.2 apporte deux choses de plus :

- Avec Vortex 1.14 ou plus récent, le mod est installé comme un mod Vortex et apparaît dans sa
  liste. Avec un Vortex plus ancien, les fichiers sont copiés dans Data comme avant.
- L’attente après avoir appuyé sur Jouer est un écran de chargement qui suit le vrai démarrage,
  étape par étape. Si un serveur vous refuse, il dit pourquoi ; une mauvaise version affiche les
  deux versions.
