<?php

return [

    'meta' => [
        'title'       => 'Héberger un serveur multijoueur Skyrim VR · urSovngarde',
        'description' => 'Hébergez un serveur coop Skyrim VR avec le lanceur et un code de six lettres, via notre relais sans port à ouvrir, ou à la main avec une redirection du port UDP :port ou un réseau virtuel.',
    ],

    'hero' => [
        'kicker' => 'Un exécutable · un port UDP · aucun compte',
        'title'  => 'Tenir le serveur',
        'lede'   => 'Le serveur est un programme sur un PC, et il appartient à celui qui le démarre. Pas de compte, pas de lobby, pas de matchmaking.',
    ],

    'launcher' => [
        'label' => 'La voie facile',
        'title' => 'Héberger avec le lanceur',
        'steps' => [
            ['title' => 'Appuyez sur Héberger une partie',   'body' => 'Le lanceur démarre le serveur que son installation a placé à côté du mod, attend qu’il tourne vraiment, puis affiche un code de six lettres. Vous pouvez d’abord définir un mot de passe.'],
            ['title' => 'Envoyez le code',                   'body' => 'Vos amis le tapent sous Rejoindre dans leur lanceur, ou appuient sur Rejoindre à côté de votre nom dans leur liste d’amis Steam.'],
            ['title' => 'Rien à ouvrir sur votre box',       'body' => 'Avec le lanceur :relay_min ou plus récent des deux côtés, la partie passe par un relais à nous, en service depuis le :relay_since. Il est récent : si un ami n’arrive pas à se connecter, utilisez l’une des deux méthodes décrites plus bas, sous Réseau.'],
            ['title' => 'Arrêtez d’héberger quand vous avez fini', 'body' => 'Le code est retiré et le serveur se ferme.'],
        ],
    ],

    'start' => [
        'label' => 'À la main',
        'title' => 'Sans le lanceur',
        'steps' => [
            ['title' => 'Gardez le dossier Server quelque part', 'body' => 'N’importe où sur la machine qui hébergera. Le serveur n’a pas besoin du jeu : une machine allumée en permanence ou un vieux portable font l’affaire.'],
            ['title' => 'Lancez host-server.bat',               'body' => 'Il refuse de démarrer un deuxième serveur, démarre celui-ci, et affiche l’adresse à distribuer. Une console s’ouvre et indique le port.'],
            ['title' => 'Laissez la fenêtre ouverte',           'body' => 'La fermer met fin à la session. Sous Windows 11 elle peut s’ouvrir comme onglet d’un Terminal existant. Si vous voyez deux onglets serveur, fermez les deux et recommencez.'],
            ['title' => 'Regardez les gens arriver',            'body' => 'La console affiche <em>New player … connected</em>. C’est le moyen le plus rapide de savoir qu’une connexion est bien arrivée jusqu’au serveur.'],
        ],
    ],

    'reach' => [
        'label' => 'Réseau',
        'title' => 'Se rendre joignable',
        'lede'  => 'Avec le relais du lanceur, vous pouvez en général sauter cette section. Quand il ne fonctionne pas pour vous, il reste deux façons, et la seconde est plus simple.',

        'forward' => [
            'label' => 'Rediriger un port',
            'body'  => 'Redirigez <strong>:protocol :port</strong> dans votre box vers le PC qui fait tourner le serveur, donnez-lui un bail statique pour que la règle ne dérive pas, et autorisez-le dans le pare-feu Windows. Distribuez ensuite votre adresse publique. <code>api.ipify.org</code> vous la donnera, et votre FAI peut la changer après un redémarrage de la box.',
            'rule'  => 'Une ligne dans Terminal (Administrateur), une seule fois :',
            'cmd'   => 'New-NetFirewallRule -DisplayName "Skyrim Together Server (UDP :port)" -Direction Inbound -Protocol UDP -LocalPort :port -Action Allow -Profile Any',
        ],

        'vpn' => [
            'label' => 'Ou ignorer la box',
            'body'  => 'Mettez tout le monde sur un réseau local virtuel (Tailscale, ZeroTier ou Radmin VPN) et distribuez l’adresse qu’il vous donne. Pas de redirection, pas d’IP publique, rien d’exposé sur Internet, et ça survit au changement d’adresse par votre FAI. Pour deux ou trois amis, c’est presque toujours la bonne réponse.',
        ],

        'self' => 'Héberger sur le PC où vous jouez est normal et prévu. Vous vous connectez à vous-même sur <code>127.0.0.1::port</code>, la même adresse que tout le monde, sans le trajet.',
    ],

    'settings' => [
        'label' => 'Configuration',
        'title' => 'Réglages du serveur',
        'lede'  => 'Modifiez <code>Server\\config\\STServer.ini</code> serveur fermé. Voici ceux qui méritent d’être connus.',
        'head'  => ['setting' => 'Réglage', 'default' => 'Défaut', 'what' => 'Ce qu’il fait'],
        'rows'  => [
            ['k' => 'uPort',             'v' => ':port',  'd' => 'Le port UDP sur lequel les joueurs se connectent. Si vous le changez, changez aussi la règle de redirection.'],
            ['k' => 'sPassword',         'v' => 'vide',   'd' => 'En définir un pour tenir les inconnus à l’écart. Les joueurs le mettent sur la deuxième ligne de leur connect.txt.'],
            ['k' => 'bAutoPartyCreate',  'v' => 'true',   'd' => 'Le premier joueur connecté obtient un groupe, pour que personne n’ait à chercher un menu de groupe en VR.'],
            ['k' => 'bAutoPartyJoin',    'v' => 'true',   'd' => 'Les autres le rejoignent automatiquement. Nécessaire au partage de la météo et des quêtes.'],
            ['k' => 'bEnablePvp',        'v' => 'false',  'd' => 'Si les joueurs peuvent se blesser entre eux. Pensez à vos amitiés avant de changer ça.'],
            ['k' => 'bEnableDeathSystem','v' => 'true',   'd' => 'La mort vous fait réapparaître dans un temple au lieu de charger une sauvegarde, ce qui désynchroniserait le monde.'],
            ['k' => 'bAllowMO2',         'v' => 'true',   'd' => 'Autorise les clients lancés via Mod Organizer 2. Laissez activé.'],
            ['k' => 'bAllowSKSE',        'v' => 'true',   'd' => 'Autorise SKSE. Laissez activé ; rien ne fonctionne sans.'],
            ['k' => 'bEnableModCheck',   'v' => 'false',  'd' => 'Impose des listes de mods identiques à l’octet près. Désactivé par choix. À peu près identique suffit.'],
        ],
    ],

    'rules' => [
        'label' => 'Pièges',
        'title' => 'Deux règles qui mordent',
        'items' => [
            ['title' => 'Les builds qui parlent les mêmes messages se connectent', 'body' => 'Quel que soit leur numéro de version. Une release qui change les messages réseau le dit, et alors tout le monde met à jour, serveur compris. Un joueur refusé reçoit les deux versions, dans le jeu et dans l’écran de chargement du lanceur.'],
            ['title' => 'uGridsToLoad reste à 5',          'body' => 'Le serveur refuse toute autre valeur. C’est la valeur par défaut de toutes les listes, donc cela n’attrape que ceux qui sont allés bidouiller.'],
        ],
    ],

    'linux' => [
        'title' => 'Linux',
        'body'  => 'La build Linux du serveur dédié ne compile pas sur le code actuel pour le moment. Elle compilait auparavant, et c’est en cours de correction. D’ici là, demandez.',
    ],

    'cta' => [
        'title'   => 'Le serveur tourne. Faites entrer tout le monde',
        'body'    => 'Envoyez-leur l’adresse, la build et le guide d’installation.',
        'primary' => 'Guide d’installation',
        'secondary' => 'Télécharger la build',
    ],
];
