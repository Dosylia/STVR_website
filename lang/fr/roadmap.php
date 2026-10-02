<?php

return [

    'meta' => [
        'title'       => 'Skyrim Together VR — feuille de route et bugs connus',
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
                'state' => 'next',
                'title' => 'Des corps qui restent où on les laisse',
                'body'  => 'Traîner un cadavre d’abord, puis manipuler le corps d’un autre joueur et les PNJ vivants. Un corps traîné dans une embrasure d’un côté et laissé à découvert de l’autre est le genre de chose qu’on ne remarque qu’au pire moment.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Personne sous le sol',
                'body'  => 'Des PNJ arrivent parfois sous le sol sur lequel ils devraient se tenir. Ils sont synchronisés — simplement synchronisés à la mauvaise altitude.',
            ],
            [
                'n' => 6,
                'state' => 'later',
                'title' => 'Les coups portent là où est l’arme',
                'body'  => 'Un coup en VR est un vrai coup, pas une animation déclenchée, et le jeu de l’autre joueur doit être d’accord sur l’endroit où l’acier est réellement passé. Les épées ont déjà du poids ; la détection des coups doit le mériter.',
            ],
        ],
    ],

    'issues' => [
        'label' => 'Aujourd’hui',
        'title' => 'Bugs connus',
        'lede'  => 'À jour, précis, et pas une formalité. Si vous tombez sur autre chose, c’est vraiment nouveau — envoyez le log.',
        'items' => [
            [
                'title' => 'Ça plante encore',
                'body'  => 'Moins qu’avant, et ce qui reste tourne surtout autour de la destruction simultanée de beaucoup d’acteurs. <code>collect-logs.bat</code> nous donne le dump, et le dump nomme la fonction.',
            ],
            [
                'title' => 'Franchir les cellules vite déraille',
                'body'  => 'Un bandit envoyé dans le ciel, un cadavre au mauvais endroit, une spriggan dont les coups ne portent jamais — tous signalés en traversant le pays au sprint, et c’est le fil qu’on tire en ce moment.',
            ],
            [
                'title' => 'Des PNJ sous le niveau du sol',
                'body'  => 'Correctement synchronisés, au mauvais endroit. Souvent cosmétique, parfois fatal à un combat.',
            ],
            [
                'title' => 'Les cadavres ne sont pas d’accord',
                'body'  => 'Traîner fonctionne mieux qu’avant. Deux joueurs manipulant le même corps, ou un corps manipulé de loin, ne finit pas toujours au même endroit dans les deux mondes.',
            ],
            [
                'title' => 'Les compagnons peuvent rester loin derrière',
                'body'  => 'Déplacez-vous vite et votre suivant peut se retrouver plusieurs cellules en arrière. Le client relâche des acteurs dans des cellules que le jeu a déchargées : un comportement correct avec un résultat qui ne l’a pas l’air.',
            ],
        ],
        'report' => [
            'title' => 'Si vous en trouvez un nouveau',
            'body'  => 'Lancez <code>collect-logs.bat</code> dans le dossier du lanceur. Il dépose sur votre Bureau un zip avec le log du client, l’éventuel crash dump et les deux versions de build. Ce zip, c’est la différence entre un correctif cette semaine et une théorie ce mois-ci.',
            'cta'   => 'Ouvrir un ticket',
        ],
    ],

    'done' => [
        'label' => 'Derrière nous',
        'title' => 'Sorties de la liste récemment',
        'lede'  => 'Ce n’est pas un changelog — le journal fait office de changelog. Juste la forme des dernières semaines.',
        'items' => [
            'Les objets lâchés suivent la main qui les a lancés et atteignent le sol au lieu de flotter.',
            'Le bassin traverse le réseau : un corps se plie là où son propriétaire se plie.',
            'Une copie distante qui sort de portée et revient revient correcte.',
            'Les épées ont du poids.',
            'La jauge de vie d’un ennemi cesse d’écrire dans un menu déjà fermé.',
            'Des tests par bot sans surveillance : une régression est trouvée par une machine la nuit plutôt que par un ami un vendredi soir.',
        ],
    ],

    'cta' => [
        'title'   => 'Lire comment ça s’est vraiment passé',
        'body'    => 'Le journal contient aussi les mauvaises pistes.',
        'primary' => 'Ouvrir le journal',
    ],
];
