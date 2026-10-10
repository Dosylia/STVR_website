---
title: Un serveur que chacun peut rejoindre
date: 2026-10-10
summary: Un serveur public, une page qui montre qui s’y trouve et où, et les trois fois où la carte a perdu quelqu’un en route.
tags: réseau, site
---

Jusqu’ici, toutes les façons de jouer commencent par connaître quelqu’un. L’un de vous héberge,
l’autre reçoit un code. C’est ainsi que la plupart des gens joueront toujours, et c’est le bon choix
par défaut. Mais cela laisse de côté celui qui a installé le mod, qui a une soirée libre et personne
avec qui jouer.

Nous construisons donc un serveur public : un serveur qui tourne en permanence, que n’importe qui
peut rejoindre, et une page sur ce site qui montre qui s’y trouve en ce moment et où. Il n’est pas
encore ouvert. Voici ce qui existe, et ce qu’il a fallu pour en arriver là.

## Comment la page le sait

Le serveur communique son état à notre hub : son nom, son adresse, sa build, le nombre de joueurs
connectés et, pour chaque joueur, le nom du personnage et l’endroit où il se tient. Toutes les
10 secondes tant que quelqu’un est connecté, toutes les minutes quand personne ne l’est, et une
dernière fois, avec la mention hors ligne, quand on l’arrête proprement.

Il ne le fait que sur le serveur public. Le réglage est désactivé sur tous les autres serveurs, y
compris celui d’un ami, et il demande une clé que seuls la machine du serveur public et le hub
détiennent.

Le hub garde le dernier état et rien de plus ancien. Si le serveur reste silencieux pendant trois
minutes, le hub le déclare hors ligne et en retire les joueurs. Rien n’est conservé de qui a joué ni
de quand.

Ce qui est envoyé au sujet d’un joueur, c’est le nom de son personnage, jamais un nom Steam, un
compte ou une adresse.

## Ne pas trop solliciter le hub

Le hub tourne sur une offre gratuite : 100 000 requêtes par jour, pour tout ce qu’il fait, rapports
de crash et codes d’invitation compris. Une page qui s’actualise toute seule dans le navigateur de
chaque visiteur les épuiserait en un après-midi : cent personnes qui regardent, chacune envoyant une
requête toutes les quelques secondes.

Les navigateurs ne s’adressent donc jamais au hub. Ils interrogent ce site, qui garde la dernière
réponse pendant 5 secondes et ne retourne voir le hub que lorsque la requête d’un visiteur trouve sa
copie plus vieille que cela. Quel que soit le nombre de personnes qui regardent, le hub a de nos
nouvelles au plus une fois toutes les 5 secondes, et pas du tout quand personne ne regarde.

## La carte a perdu des gens trois fois

La page représente chaque joueur par un point sur notre propre carte de Bordeciel. Le point bouge
quand le joueur bouge, et pivote pour montrer de quel côté il regarde. Mettre les points au bon
endroit a demandé trois essais.

**D’abord, les villes.** Dans les données du jeu, Blancherive, Solitude, Vendeaume, Faillaise et
Markarth sont chacune un monde à part, séparé du reste de Bordeciel. Un joueur qui franchissait la
porte de Blancherive disparaissait de la carte. Ces villes partagent pourtant les coordonnées de
Bordeciel, et nous les dessinons donc désormais sur la même carte.

**Ensuite, les DLC.** Un joueur parti pour Solstheim, ou passé par le portail du Soul Cairn,
disparaissait de la même façon. Ce sont de vrais lieux, avec leur propre sol et leurs propres
coordonnées, alors chacun a eu sa propre carte : Solstheim, sous la neige au nord et sous la cendre
au sud, et le Soul Cairn, un vide violet parsemé d’îlots de terre grise. La page les présente sous
forme d’onglets, chacun avec le nombre de joueurs qui s’y trouvent, et s’ouvre sur le plus
fréquenté.

**Enfin, le calibrage.** Une position du jeu devient un point sur un dessin grâce à deux lieux dont
on connaît la position à la fois dans le jeu et sur le dessin. Nous étions partis d’estimations pour
Blancherive et Vendeaume. Quand le serveur a commencé à envoyer les positions exactes du Fort de la
Garde de l’aube et du Château Volkihar, il s’est avéré que ces estimations plaçaient le fort à
80 pixels de l’endroit où il est dessiné, et le château carrément hors de la carte. La carte de
Bordeciel est désormais calée sur ces deux points exacts, un dans chaque coin. Les lieux situés
entre les deux sont placés à l’œil, et un relevé au marché de Blancherive nous dira de combien ils
s’écartent.

## Ne pas apparaître

Tout le monde ne tient pas à voir son personnage sur une page publique. Un joueur qui choisit de se
cacher est retiré de la liste, n’apparaît pas du tout sur la carte et est seulement compté : la page
affiche « 5 joueurs », puis « Et un autre joueur, absent de la liste ».

## État

Construit : l’envoi de l’état par le serveur, la partie côté hub, et la page avec ses trois cartes,
les points en direct, la liste des joueurs et un bouton qui ouvre le lanceur pour rejoindre.

Pas encore : le serveur lui-même n’est pas ouvert. Avant qu’il le soit, il lui faut sa clé, la carte
de Solstheim doit être relevée en deux endroits et celle du Soul Cairn en un seul, et les règles
restent à écrire. Les noms de lieux dans la liste arriveront avec la prochaine build du mod.
L’option pour se cacher et le « Rejoindre » en un clic arriveront avec la version du lanceur qui
ouvrira le serveur.

Quand il ouvrira, vous le trouverez dans le menu de ce site, et ici.
