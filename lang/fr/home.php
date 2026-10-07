<?php

return [

    'meta' => [
        'title'       => 'urSovngarde : vous n’êtes plus le seul Enfant de dragon',
        'description' => 'Le coop libre et gratuit pour Skyrim VR. Votre liste de mods, votre sauvegarde, votre serveur, et quelqu’un debout à côté de vous, à sa vraie taille, avec ses vraies mains.',
    ],

    'hero' => [
        'kicker'   => 'Open source · GPLv3 · portage VR de Skyrim Together Reborn',
        'title'    => 'Vous n’êtes plus le seul Enfant de dragon',
        'lede'     => 'Le coop pour Skyrim VR. Votre liste de mods, votre sauvegarde, votre serveur, et quelqu’un réellement dans la pièce avec vous, à sa propre taille, avec ses propres mains.',
        'primary'  => 'Récupérer la build',
        'secondary'=> 'Comment l’installer',
        'scroll'   => 'Continuer',
        'caption'  => 'Deux sur la crête. L’un des deux n’est pas un PNJ.',
    ],

    'stats' => [
        'version_label'  => 'Build actuelle',
        'version_none'   => 'En préparation',
        'version_rolling'=> 'Dernière build',
        'port_label'     => 'Votre serveur, votre port',
        'port_note'      => 'UDP, redirigé ou via un VPN',
        'game_label'     => 'Tourne sur',
        'game_value'     => 'Skyrim VR :version',
        'game_note'      => 'SKSE VR et la VR Address Library',
        'price_label'    => 'Prix',
        'price_value'    => 'Gratuit, pour toujours',
        'price_note'     => 'GPLv3, code ouvert',
    ],

    'plain' => [
        'label' => 'Clairement',
        'title' => 'De quoi il s’agit, en vrai',
        'body'  => 'Skyrim Together Reborn a apporté le coop à Skyrim Special Edition. Skyrim VR est un autre exécutable : d’autres adresses mémoire, d’autres classes moteur, et un corps là où il n’y avait qu’une caméra. Ceci est ce mod, démonté puis remonté pour la build VR, par deux développeurs full-stack qui ont appris le C++ et la rétro-ingénierie en chemin, ce qui est rassurant ou inquiétant selon le tempérament.',
        'body2' => 'C’est gratuit, le code est public, et rien ne passe jamais par un serveur qui nous appartient. Vous hébergez, ou votre ami héberge. Personne ne crée de compte.',
    ],

    'features' => [
        'label'  => 'Ce qu’il fait',
        'title'  => 'Tout ce qui suit est dans la build que vous pouvez télécharger',
        'lede'   => 'Rien ici n’est une promesse : tout est dans la build du jour. Ce qui manque encore est nommé sur la feuille de route.',

        'items' => [
            [
                'rune'  => 'ᛗ',
                'title' => 'Il est vraiment là',
                'body'  => 'La tête, les mains et le bassin traversent le réseau. Avec VRIK, votre ami a un corps, alors quand il se penche pour regarder au coin d’un mur, vous le voyez se pencher. Quand il pointe du doigt, vous pouvez suivre son bras. Pas un casque flottant. Quelqu’un.',
            ],
            [
                'rune'  => 'ᛟ',
                'title' => 'Un menu fait pour la VR',
                'body'  => 'Le mod occupe son propre onglet dans le tableau de bord SteamVR : pointeur laser, clavier SteamVR, lisible à bonne distance. F6 connecte et déconnecte sans retirer le casque.',
            ],
            [
                'rune'  => 'ᚦ',
                'title' => 'Vos mods, intacts',
                'body'  => 'Mod Organizer 2, Vortex, une liste Wabbajack comme FUS, ou aucun gestionnaire du tout. Votre ordre de chargement reste le vôtre. Le lanceur démarre le jeu et charge SKSE à votre place. Vous ne retouchez plus jamais au loader SKSE.',
            ],
            [
                'rune'  => 'ᛒ',
                'title' => 'Un seul monde, pas deux',
                'body'  => 'Les quêtes, la météo et l’heure sont partagées par le groupe, et le groupe se forme tout seul dès que vous vous connectez. Un objet lâché tombe sur le même sol dans les deux casques, et suit en chemin la main qui l’a lancé.',
            ],
            [
                'rune'  => 'ᚾ',
                'title' => 'Votre serveur, vos règles',
                'body'  => 'Un exécutable et un port UDP. Redirigez-le, ou mettez tout le monde sur Tailscale, ZeroTier ou Radmin et oubliez la box. Mot de passe, PvP, conséquences de la mort : c’est vous qui décidez. Pas de lobby, pas de matchmaking, pas de compte.',
            ],
            [
                'rune'  => 'ᛉ',
                'title' => 'Il se reconnecte tout seul',
                'body'  => 'Une connexion perdue réessaie au bout de 5 secondes, puis 10, 20, 30 et 60, et vous le dit à l’écran. Une connexion refusée ne réessaie pas et explique pourquoi (mauvaise build, mauvais mot de passe) au lieu de vous laisser devant une porte de chargement.',
            ],
        ],
    ],

    'honest' => [
        'label' => 'L’autre moitié de la vérité',
        'title' => 'Et ça va casser',
        'body'  => 'C’est un mod d’un mod d’un moteur de jeu, poussé dans un casque. Ça plante. Des PNJ passent parfois à travers le sol. Un corps traîné dans un monde reste parfois immobile dans l’autre. Nous tenons une liste de bugs connus qui est précise plutôt que désolée, un journal qui admet quand un diagnostic était faux, et un fichier .bat qui rassemble vos logs et votre crash dump dans un seul zip à nous envoyer.',
        'cta_roadmap' => 'Voir ce qui casse',
        'cta_devlog'  => 'Lire le journal',
    ],

    'tips' => [
        'label' => 'Écran de chargement',
        'items' => [
            'Le serveur refuse tout client dont la build ne correspond pas. La notification de connexion affiche les deux versions : dix secondes pour comprendre.',
            'uGridsToLoad doit valoir 5. C’est la valeur par défaut de toutes les listes Wabbajack, et le serveur n’en acceptera aucune autre.',
            'C’est VRIK qui donne un corps à votre ami. Sans lui, il est toujours là, mais il y a nettement moins à voir.',
            'L’hôte se connecte à son propre serveur sur 127.0.0.1, la même adresse que tout le monde, sans le trajet.',
            'Jouez tous les deux avec la même liste de mods. « Il voit un ours, je vois un loup » est presque toujours deux ordres de chargement différents.',
        ],
    ],

    'steps' => [
        'label' => 'Se lancer',
        'title' => 'De rien du tout à en train de jouer',
        'lede'  => 'Quatre étapes. La plus longue est le téléchargement.',
        'items' => [
            ['n' => '1', 'title' => 'Préparer Skyrim VR',       'body' => 'SKSE VR et la VR Address Library for SKSEVR, comme n’importe quel mod SKSE. Engine Fixes VR et VRIK si vous voulez que ce soit bien, et pas seulement fonctionnel.'],
            ['n' => '2', 'title' => 'Poser le mod',             'body' => 'Un dossier à installer dans votre gestionnaire, un plugin à cocher, et le dossier du lanceur où vous voulez.'],
            ['n' => '3', 'title' => 'Indiquer un serveur',      'body' => 'Lancez setup-connect.bat une fois et tapez l’adresse de l’hôte. L’hôte tape 127.0.0.1 et héberge depuis le PC sur lequel il joue.'],
            ['n' => '4', 'title' => 'Charger une sauvegarde',   'body' => 'Démarrez avec SkyrimTogetherVR.exe et chargez n’importe quelle sauvegarde. Cinq secondes plus tard, la connexion se fait seule et vous met tous les deux dans un groupe.'],
        ],
        'cta' => 'Le guide complet',
    ],

    'devlog' => [
        'label' => 'À l’établi',
        'title' => 'Ce qui a cassé cette semaine, et ce que c’était vraiment',
        'cta'   => 'Toutes les entrées',
        'empty' => 'Les premières entrées sont en cours d’écriture.',
    ],

    'cta' => [
        'title' => 'Bordeciel est un grand pays à traverser seul',
        'body'  => 'Gratuit, open source, et ça tourne sur la liste de mods que vous avez déjà.',
        'primary' => 'Récupérer la build',
        'secondary' => 'Lire le guide d’installation',
    ],
];
