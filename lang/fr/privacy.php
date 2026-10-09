<?php

return [

    'meta' => [
        'title'       => 'urSovngarde : confidentialité',
        'description' => 'Ce que contient un rapport de plantage et comment il est supprimé au bout de :days jours, ce que gardent les codes d’invitation et le relais, et les deux cookies que dépose ce site.',
    ],

    'hero' => [
        'kicker' => 'Rapports de plantage, hébergement et vos données',
        'title'  => 'Confidentialité',
        'lede'   => 'Ce que contient un rapport de plantage, ce que garde un hébergement passé par nous, ce que dépose ce site, et pendant combien de temps.',
    ],

    'discord' => 'notre serveur Discord',

    'sections' => [

        [
            'title' => 'Rien ne part sans un oui',
            'body'  => [
                'Quand le jeu se ferme après un plantage, le lanceur demande s’il peut envoyer un rapport. Vous pouvez répondre pour ce plantage seulement, oui ou non, ou une fois pour toutes : toujours ou jamais. Toujours et jamais se changent plus tard dans les réglages du lanceur.',
                'Si le jeu s’est fermé pendant que vous étiez dans le casque, la question attend la prochaine ouverture du lanceur. Fermer la fenêtre sans répondre n’envoie rien.',
            ],
        ],

        [
            'title' => 'Ce que contient un rapport',
            'body'  => ['Uniquement des fichiers liés au plantage, et uniquement ceux de la dernière journée :'],
            'items' => [
                'Le journal du mod lui-même : à quoi il s’est connecté, ce qu’il a gardé synchronisé entre les deux jeux, et les erreurs qu’il a rencontrées.',
                'Le rapport de Crash Logger pour chaque plantage : à quel endroit du code du jeu il s’est produit, votre liste de plugins et de plugins SKSE, votre version de Windows et les composants de votre PC (processeur, carte graphique, mémoire, modèle de casque).',
                'Le journal du serveur, si c’est vous qui hébergiez.',
                'La version du mod que vous utilisiez.',
                'Un petit fichier de vidage de quelques mégaoctets : ce que faisaient les fils d’exécution du jeu au moment du plantage. Il peut contenir de petits fragments de ce que le jeu avait en mémoire à cet instant.',
                'Votre réponse à une question : le jeu a-t-il planté pendant que vous jouiez ?',
            ],
        ],

        [
            'title' => 'Ce qui est retiré d’abord',
            'body'  => ['Sur votre PC, avant tout envoi, dans chaque fichier, vidage compris :'],
            'items' => [
                'Votre nom d’utilisateur Windows, partout où il apparaît dans un chemin de fichier.',
                'Toutes les adresses IP et les adresses de serveur.',
                'Votre identifiant Discord.',
                'Les noms des joueurs et des personnages, remplacés par « Joueur A », « Joueur B », et ainsi de suite.',
            ],
        ],

        [
            'title' => 'Ce qui ne quitte jamais votre PC',
            'items' => [
                'Vos sauvegardes.',
                'Les captures d’écran, et les images de toute sorte.',
                'Les vidages complets. Ils pèsent des centaines de mégaoctets et contiennent bien plus de la mémoire du jeu qu’un rapport n’en a besoin.',
                'Vos mods, vos fichiers de réglages et les fichiers de votre liste de mods.',
                'Tout ce qui n’est pas nommé sur cette page.',
            ],
        ],

        [
            'title' => 'Pourquoi nous demandons',
            'body'  => [
                'Un plantage sur un autre PC, avec une autre liste de mods, reste invisible d’ici tant que personne ne l’envoie. La plupart de ce qui a été corrigé jusqu’ici a été trouvé dans le journal de quelqu’un.',
                'Les rapports sont triés de notre côté par un programme qui regroupe les plantages identiques et les classe selon leur fréquence et le nombre de personnes touchées. Il lit des journaux ; il ne décide rien à votre sujet. Les rapports servent à cela et à rien d’autre : ni publicité, ni pistage, rien de vendu ni de partagé.',
            ],
        ],

        [
            'title' => 'Où il va et qui le lit',
            'body'  => [
                'Un rapport voyage chiffré (HTTPS) jusqu’à un petit service à nous qui tourne chez Cloudflare, et y est conservé. Seules les personnes qui travaillent sur le mod peuvent le lire : deux personnes aujourd’hui.',
                'Comme tout serveur web, ce service voit l’adresse d’où vient un rapport. Il en garde une forme brouillée (une empreinte à sens unique) pendant une heure, pour compter les rapports et bloquer les envois en masse, et ne l’enregistre jamais avec le rapport.',
                'Quand un rapport arrive, une courte ligne est publiée dans un salon privé de :discord : son numéro, sa taille, la version du mod, s’il a planté en cours de partie, et de quel plantage il s’agit, avec son nom si nous le connaissons déjà, ou l’endroit du code du jeu où il s’est produit. Jamais les journaux eux-mêmes.',
            ],
        ],

        [
            'title' => 'Combien de temps il est gardé',
            'body'  => [
                'Chaque rapport est supprimé automatiquement :days jours après son arrivée, sur le service comme sur le PC où les rapports sont lus.',
            ],
        ],

        [
            'title' => 'Supprimer un rapport',
            'body'  => [
                'Après l’envoi, le lanceur affiche le numéro du rapport et garde la liste des numéros qu’il a envoyés. Donnez un numéro sur :discord et ce rapport est supprimé partout, sans question.',
                'Choisissez « jamais » dans le lanceur et plus rien n’est envoyé à partir de là.',
            ],
        ],

        [
            'title' => 'Codes d’invitation',
            'body'  => [
                'Quand vous hébergez avec le lanceur, notre hub (le même service Cloudflare qui reçoit les rapports) conserve votre adresse publique et votre port, le fait que le serveur ait ou non un mot de passe (jamais le mot de passe lui-même), la version du lanceur et, s’il y en a une, la session de relais. Il les garde :invite_hours heures ; le lanceur les renouvelle toutes les heures tant que vous hébergez et les retire quand vous arrêtez.',
                'Quiconque a le code obtient l’adresse. Tant que vous hébergez, vos amis Steam voient « Hosting urSovngarde », et leur lanceur peut lire le code.',
            ],
        ],

        [
            'title' => 'Le relais',
            'body'  => [
                'Quand l’hébergement passe par le relais, le trafic du jeu entre vous et vos amis transite par un serveur que nous louons chez IONOS, dans un centre de données en Allemagne : le même serveur que ce site. Ce trafic est chiffré par la couche réseau du jeu lui-même, et le relais ne peut pas le lire.',
                'Le relais ne garde aucune adresse dans ses journaux. Une fois par minute, il n’écrit que des totaux : sessions, joueurs, paquets et octets. Il oublie une session 60 secondes après qu’elle est devenue silencieuse.',
            ],
        ],

        [
            'title' => 'Ce site',
            'body'  => [
                'Le site dépose deux cookies, tous deux strictement nécessaires et tous deux supprimés au bout de deux heures : <code>skyrim-together-vr-session</code>, dont le framework du site se sert pour suivre une même visite, et <code>XSRF-TOKEN</code>, un jeton de sécurité contre les formulaires falsifiés. Il n’y a ni pistage, ni mesure d’audience, ni publicité, et c’est pourquoi il n’y a pas de bandeau de cookies.',
                'Comme tout serveur web, le nôtre tient un journal d’accès qui enregistre l’adresse et l’heure de chaque requête.',
                'Quand le lanceur est téléchargé depuis ce site, ou qu’un lanceur installé demande s’il existe une mise à jour, le site le signale à notre hub, qui ajoute un au compte du jour (et, pour un téléchargement, à celui de cette version). Rien sur la personne qui télécharge n’est envoyé.',
            ],
        ],
    ],
];
