<?php

return [

    'meta' => [
        'title'       => 'urSovngarde : feuille de route et bugs connus',
        'description' => 'Les six chantiers en cours, dans l’ordre où ils méritent d’être réglés, et la liste honnête de ce qui casse aujourd’hui.',
    ],

    'hero' => [
        'kicker' => 'Six objectifs · dans l’ordre',
        'title'  => 'Ce qui vient, et ce qui casse',
        'lede'   => 'Voici la vraie liste, dans le vrai ordre. Rien n’y est coché parce que ça a été écrit : les choses en sortent quand les gens qui jouent cessent de les signaler.',
    ],

    'constellation' => [
        'label' => 'La route',
        'title' => 'Les six',
        'lede'  => 'Classés par ce qu’il vaut mieux régler d’abord, pas par ce qui est le plus facile. Tout le reste se mesure à cette liste.',
        'legend' => [
            'active' => 'En cours',
            'next'   => 'Ensuite',
            'later'  => 'Plus tard',
        ],
        'goals' => [
            [
                'n' => 1,
                'state' => 'active',
                'title' => 'Plus de crashs',
                'body'  => 'Tout le reste est décoratif si la session s’arrête au bout de vingt minutes. L’essentiel du travail de ce mois est passé ici : vérifications de nullité dans chaque hook, chemins de destruction qui ne confient plus un acteur supprimé à du code qui le tient encore, et un outil de crash dump qui nomme la fonction au lieu d’inviter à deviner.',
            ],
            [
                'n' => 2,
                'state' => 'active',
                'title' => 'Le monde, identique dans les deux casques',
                'body'  => 'Si vous l’avez tué, il est mort pour lui aussi ; s’il a pillé le coffre, il est vide pour vous. Le plus long reste les limites de cellules : les franchir vite est l’origine des rapports les plus étranges.',
            ],
            [
                'n' => 3,
                'state' => 'next',
                'title' => 'Les interactions VRIK, vues par tous',
                'body'  => 'La VR a des gestes qu’un jeu plat n’a jamais eus : attraper par-dessus l’épaule, rengainer à la hanche, saisir quelque chose en l’air. Ce sont eux qui font lire un corps comme une personne, et ils doivent traverser le réseau tels quels plutôt que sous la forme de l’animation la plus proche.',
            ],
            [
                'n' => 4,
                'state' => 'active',
                'title' => 'Des corps qui restent où on les laisse',
                'body'  => 'Traîner un cadavre fonctionne, et les deux joueurs le voient. Un cadavre repose désormais au même endroit dans les deux mondes. Reste à faire : le corps d’un autre joueur, et les PNJ vivants.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Personne sous le sol',
                'body'  => 'Des PNJ arrivent parfois sous le sol sur lequel ils devraient se tenir. Ils sont synchronisés, simplement synchronisés à la mauvaise altitude.',
            ],
            [
                'n' => 6,
                'state' => 'active',
                'title' => 'Les coups portent là où est l’arme',
                'body'  => 'Des lames qui se rencontrent se sentent, s’entendent et se voient chez les deux joueurs, et c’est l’écran du défenseur qui décide si un coup a été paré. À partir de la prochaine release, seule une arme ou un bouclier pare. Ensuite : des lames qui s’arrêtent physiquement l’une l’autre.',
            ],
        ],
    ],

    'issues' => [
        'label' => 'Aujourd’hui',
        'title' => 'Bugs connus',
        'lede'  => 'À jour, précis, et pas une formalité. Si vous tombez sur autre chose, c’est vraiment nouveau. Envoyez le log.',
        'items' => [
            [
                'title' => 'Ça plante encore',
                'body'  => 'Moins qu’avant, et ce qui reste tourne surtout autour de la destruction simultanée de beaucoup d’acteurs. Le rapport de plantage du lanceur nous donne le dump, et le dump nomme la fonction.',
            ],
            [
                'title' => 'Franchir les cellules vite déraille',
                'body'  => 'Un bandit envoyé dans le ciel, un cadavre au mauvais endroit, une spriggan dont les coups ne portent jamais, tous signalés en traversant le pays au sprint, et c’est le fil qu’on tire en ce moment.',
            ],
            [
                'title' => 'Des PNJ sous le niveau du sol',
                'body'  => 'Correctement synchronisés, au mauvais endroit. Souvent cosmétique, parfois fatal à un combat.',
            ],
            [
                'title' => 'Les corps déplacés peuvent encore diverger',
                'body'  => 'Un cadavre repose désormais au même endroit dans les deux mondes, et les deux joueurs voient quand on en traîne un. Le corps d’un autre joueur, et les PNJ vivants qu’on déplace, peuvent encore finir à des endroits différents.',
            ],
            [
                'title' => 'Le PvP est jeune',
                'body'  => 'La parade est nouvelle. Trois façons dont un coup traversait une parade ont été trouvées les 8 et 9 octobre, et toutes trois sont corrigées pour la prochaine release. Dans l’un des deux jeux, la copie de l’autre joueur ne tient parfois aucune arme, et ne peut alors pas être parée.',
            ],
            [
                'title' => 'L’hébergement via le relais est nouveau',
                'body'  => 'En service depuis le :relay_since, et pas encore éprouvé sur une session complète. Si un ami n’arrive pas à se connecter, redirigez le port ou utilisez Tailscale, comme indiqué sur la page d’hébergement.',
            ],
            [
                'title' => 'Vortex antérieur à :vortex_min',
                'body'  => 'Le lanceur copie les fichiers dans Data, comme avant, et ils n’apparaissent pas dans la liste des mods de Vortex. Mettre Vortex à jour règle le problème.',
            ],
            [
                'title' => 'Les compagnons peuvent rester loin derrière',
                'body'  => 'Déplacez-vous vite et votre suivant peut se retrouver plusieurs cellules en arrière. Le client relâche des acteurs dans des cellules que le jeu a déchargées : un comportement correct avec un résultat qui ne l’a pas l’air.',
            ],
        ],
        'report' => [
            'title' => 'Si vous en trouvez un nouveau',
            'body'  => 'Acceptez quand le lanceur propose d’envoyer un rapport de plantage. Sans le lanceur, lancez <code>collect-logs.bat</code> dans le dossier du lanceur propre au mod : il dépose sur votre Bureau un zip avec le log du client, l’éventuel crash dump et les deux versions de build. Ce rapport, c’est la différence entre un correctif cette semaine et une théorie ce mois-ci.',
            'cta'   => 'Ouvrir un ticket',
        ],
    ],

    'done' => [
        'label' => 'Derrière nous',
        'title' => 'Sorties de la liste récemment',
        'lede'  => 'Ce n’est pas un changelog. Le journal fait office de changelog. Juste la forme des dernières semaines.',
        'items' => [
            'Un lanceur : installer, vérifier, jouer, héberger et rejoindre avec un code.',
            'Héberger sans ouvrir de port, grâce à un relais à nous.',
            'Des lames qui se rencontrent se sentent, s’entendent et se voient chez les deux joueurs.',
            'Une suivante appartient au jeu du joueur qu’elle suit.',
            'Un cadavre repose au même endroit dans les deux mondes.',
            'Des crash dumps assez petits pour être envoyés.',
            'Des tests par bot sans surveillance : une régression est trouvée par une machine la nuit plutôt que par un ami un vendredi soir.',
        ],
    ],

    'cta' => [
        'title'   => 'Lire comment ça s’est vraiment passé',
        'body'    => 'Le journal contient aussi les mauvaises pistes.',
        'primary' => 'Ouvrir le journal',
    ],
];
