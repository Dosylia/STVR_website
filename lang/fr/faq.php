<?php

return [

    'meta' => [
        'title'       => 'Skyrim Together VR — questions',
        'description' => 'Est-ce compatible avec ma liste de mods ? Est-ce payant ? Est-ce que je risque un ban ? Puis-je jouer avec quelqu’un sur Special Edition ? Les réponses.',
    ],

    'hero' => [
        'kicker' => 'Celles qui reviennent chaque semaine',
        'title'  => 'Questions',
        'lede'   => 'Des réponses courtes. Et quand une réponse courte serait un mensonge, une réponse plus longue.',
    ],

    'groups' => [

        [
            'title' => 'Les bases',
            'items' => [
                [
                    'q' => 'C’est quoi, en une phrase ?',
                    'a' => 'Un mod libre et gratuit qui permet de jouer à Skyrim VR entre amis, sur un serveur que l’un de vous fait tourner.',
                ],
                [
                    'q' => 'Est-ce que c’est payant ?',
                    'a' => 'Non, et ça ne peut pas l’être. La licence est la GPLv3, héritée de Skyrim Together Reborn : le code reste public et n’importe qui peut le compiler. Il vous faut votre propre copie de Skyrim VR, c’est tout.',
                ],
                [
                    'q' => 'C’est la même chose que Skyrim Together Reborn ?',
                    'a' => 'C’est ce mod, porté. Reborn vise Skyrim Special Edition — un autre exécutable, d’autres adresses mémoire, et rien de VR. Chaque accroche moteur a dû être retrouvée pour la build VR, et tout ce qui touche aux mains et au casque n’existait pas du tout. Le multijoueur en dessous est le travail de Tilted Phoques et le mérite leur revient.',
                ],
                [
                    'q' => 'Puis-je jouer avec quelqu’un sur Special Edition ?',
                    'a' => 'Non. Exécutable différent, build différente, disposition du monde différente. Il vous faut tous les deux Skyrim VR.',
                ],
                [
                    'q' => 'On peut jouer à combien ?',
                    'a' => 'C’est pensé et testé pour de petits groupes — deux à quatre amis. Il n’y a pas de limite technique de lobby, mais personne ne l’a emmené en foule, et la réponse honnête est qu’une foule trouverait les aspérités plus vite que vous ne le souhaitez.',
                ],
            ],
        ],

        [
            'title' => 'Mods et compatibilité',
            'items' => [
                [
                    'q' => 'Est-ce compatible avec ma liste de mods ?',
                    'a' => 'Probablement, et c’est tout l’intérêt : il se charge à côté de ce que vous avez déjà, via MO2, Vortex ou une liste Wabbajack. La seule exigence stricte est que <code>uGridsToLoad</code> reste à 5.',
                ],
                [
                    'q' => 'Faut-il les mêmes mods tous les deux ?',
                    'a' => 'Pas à l’octet près — la vérification des mods est volontairement désactivée. Mais plus les deux listes sont proches, moins il y a de surprises. Tout ce qui change ce qui existe dans le monde, ou ce qu’une créature est, finira par produire « il voit un ours, je vois un loup ».',
                ],
                [
                    'q' => 'VRIK est-il nécessaire ?',
                    'a' => 'Techniquement non. En pratique oui. VRIK est ce qui vous donne un corps, et votre corps est ce que votre ami voit. Sans lui vous êtes toujours là — simplement beaucoup moins visible.',
                ],
                [
                    'q' => 'Et avec les listes Wabbajack comme FUS ?',
                    'a' => 'Oui. FUS est la liste sur laquelle le mod est développé au quotidien. Installez le dossier du mod comme n’importe quel autre et ajoutez le lanceur comme exécutable.',
                ],
                [
                    'q' => 'Ça marche sur Quest ?',
                    'a' => 'Uniquement en PC VR — Virtual Desktop, Air Link, un câble. C’est un mod PC pour le jeu PC ; un casque autonome n’a pas de Skyrim VR à modder.',
                ],
            ],
        ],

        [
            'title' => 'Sécurité et bon sens',
            'items' => [
                [
                    'q' => 'Je risque un bannissement ?',
                    'a' => 'Il n’y a rien dont être banni. Skyrim VR n’a ni anti-triche ni composante en ligne, et ceci ne parle jamais à un serveur qui nous appartient. Vos sauvegardes sont à vous, sur votre disque.',
                ],
                [
                    'q' => 'Pourquoi le lanceur remplace-t-il l’exécutable du jeu ?',
                    'a' => 'Parce que c’est ainsi qu’on entre dans un jeu dont le code est chiffré sur le disque. C’est aussi exactement la forme d’une chose dont il faut se méfier, donc : le code est public, la licence le maintient public, et la release est produite par un script du même dépôt. La compiler vous-même est une réponse parfaitement valable.',
                ],
                [
                    'q' => 'Est-ce que ça peut corrompre ma sauvegarde ?',
                    'a' => 'Ce n’est pas arrivé, et ce n’est pas conçu pour y écrire quoi que ce soit de permanent. Sauvegardez quand même vos sauvegardes. Vous faites tourner une alpha d’un portage VR d’un mod multijoueur : une copie ne vous coûte rien, l’alternative vous coûte une partie.',
                ],
                [
                    'q' => 'Mon adresse IP est-elle exposée ?',
                    'a' => 'À celui qui tient le serveur et à ceux qui y sont, oui — comme dans tout jeu où un ami héberge. Si cela vous gêne, utilisez un réseau virtuel type Tailscale ou ZeroTier plutôt qu’une redirection de port : plus rien n’est alors joignable depuis Internet.',
                ],
            ],
        ],

        [
            'title' => 'Où ça en est',
            'items' => [
                [
                    'q' => 'C’est fini ?',
                    'a' => 'Non. C’est jouable, ce qui est autre chose et beaucoup plus récent. Ça plante, des PNJ finissent parfois sous le sol, et les corps ne sont pas toujours d’accord d’un casque à l’autre. La feuille de route nomme les six chantiers en cours, dans l’ordre.',
                ],
                [
                    'q' => 'Quelque chose a cassé. Que vous faut-il ?',
                    'a' => 'Lancez <code>collect-logs.bat</code> dans le dossier du lanceur et envoyez le zip déposé sur votre Bureau. Il contient le log client, le crash dump et les versions de build. Un dump nomme la fonction exacte ; une description nomme une impression.',
                ],
                [
                    'q' => 'Y aura-t-il une page Nexus ?',
                    'a' => 'Oui, dès que la liste de crashs sera assez courte pour qu’un nouveau venu passe une bonne soirée plutôt qu’une soirée intéressante.',
                ],
                [
                    'q' => 'Puis-je aider ?',
                    'a' => 'Oui. Jouer et rapporter précisément vaut plus qu’il n’y paraît : l’essentiel de ce qui a été corrigé a été trouvé dans le log de quelqu’un. Si vous faites de la rétro-ingénierie, il reste une courte liste d’adresses moteur non mappées pour la VR, et le dépôt explique comment les autres ont été trouvées.',
                ],
            ],
        ],
    ],

    'cta' => [
        'title'   => 'Pas de réponse ici ?',
        'body'    => 'Ouvrez un ticket, ou venez poser la question.',
        'primary' => 'Demander sur GitHub',
    ],
];
