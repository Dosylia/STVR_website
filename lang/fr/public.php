<?php

return [

    'meta' => [
        'title'       => 'Serveur public Skyrim VR · urSovngarde',
        'description' => 'Un serveur urSovngarde ouvert à tous : qui s’y trouve en ce moment, où sur la carte, et comment le rejoindre.',
    ],

    'hero' => [
        'kicker' => 'Ouvert à tous · sans code d’invitation',
        'title'  => 'Le serveur public',
        'lede'   => 'Un serveur que nous laissons tourner pour tous ceux qui ont le mod. Voyez qui est connecté, où ils se trouvent, et rejoignez-les.',
    ],

    // Shown instead of everything below while the server or its status is not live.
    'closed' => [
        'title' => 'Pas encore ouvert',
        'body'  => 'Le serveur public est en construction. En attendant son ouverture, jouez entre amis : hébergez une partie dans le lanceur et envoyez-leur son code de six lettres.',
        'cta'   => 'Héberger le vôtre',
        'sample' => 'Aperçu de développement : le serveur affiché sur cette page est fictif.',
    ],

    'status' => [
        'label'    => 'En ce moment',
        'online'   => 'En ligne',
        'offline'  => 'Hors ligne',
        'offline_body' => 'Le serveur ne répond pas pour le moment. Il redémarre peut-être pour une mise à jour ; revenez dans quelques minutes.',
        'players'  => 'Joueurs',
        'of'       => ':count sur :max',
        'address'  => 'Adresse',
        'version'  => 'Build',
        'protocol' => 'Jeu de messages',
        'password' => 'Mot de passe',
        'password_yes' => 'Oui, demandez sur Discord',
        'password_no'  => 'Aucun',
        'up_since' => 'En ligne depuis',
        'updated'  => 'État à :time',
    ],

    'join' => [
        'label' => 'Rejoindre',
        'title' => 'Comment rejoindre',
        'steps' => [
            ['title' => 'Ayez une build qui comprend ses messages', 'body' => 'Le serveur fait tourner la build :version, jeu de messages :protocol. Toute build qui a le même jeu de messages se connecte, donc une version voisine fonctionne souvent aussi. Si la vôtre est refusée, le lanceur affiche les deux versions, et la page de téléchargement propose la bonne.'],
            ['title' => 'Saisissez l’adresse',    'body' => 'Dans le lanceur, ouvrez Rejoindre, choisissez « ou une adresse » et collez l’adresse ci-dessus. Sans le lanceur, mettez-la sur la première ligne de votre connect.txt.'],
            ['title' => 'Chargez n’importe quelle sauvegarde', 'body' => 'Le jeu rejoint le serveur quelques secondes après le chargement de la sauvegarde. Votre personnage et votre sauvegarde restent les vôtres.'],
        ],
        'copy' => 'Copier l’adresse',
        'button' => 'Rejoindre avec le lanceur',
        'button_note' => 'Le lanceur demande avant de rejoindre. S’il ne se passe rien, mettez le lanceur à jour : les anciennes versions ne connaissent pas ce lien.',
    ],

    'who' => [
        'label' => 'Sur le serveur',
        'title' => 'Qui est là',
        'none'  => 'Personne n’est connecté pour l’instant. Soyez le premier.',
        'inside' => 'En intérieur',
        'note'  => 'Noms des personnages, tels que les joueurs les ont choisis en jeu, et lieux dans la langue du jeu de chaque joueur. En intérieur, un joueur apparaît dans la liste sans point sur la carte.',
        'hidden' => '{1} Et un autre joueur, absent de la liste.|[2,*] Et :count autres joueurs, absents de la liste.',
        'hide' => 'Vous préférez ne pas apparaître ici ? Dans le lanceur : « Me cacher de la page du serveur public ».',
    ],

    'map' => [
        'label'  => 'Où ils sont',
        'title'  => 'La carte',
        'note'   => 'Actualisée toutes les :seconds secondes tant que vous la regardez. Nos propres dessins, assez précis pour dire « près de Rivebois ».',
        'switch' => 'Choisir une carte',
        'title_solstheim' => 'Carte de Solstheim avec les joueurs du serveur public',
        'title_soul_cairn' => 'Carte du Soul Cairn avec les joueurs du serveur public',
        'red_mountain' => 'Mont Écarlate',
        // The areas a player can be outdoors in (config stvr.public_server.areas). Skyrim and Solstheim have a map.
        'areas'  => [
            'skyrim'         => 'Bordeciel',
            'solstheim'      => 'Solstheim',
            'blackreach'     => 'Griffenoire',
            'sovngarde'      => 'Sovngarde',
            'skuldafn'       => 'Skuldafn',
            'soul_cairn'     => 'Soul Cairn',
            'forgotten_vale' => 'Vallée oubliée',
            'apocrypha'      => 'Apocryphe',
            'deepwood_vale'  => 'Deepwood Vale',
        ],
        'solstheim' => [
            'raven_rock'    => 'Corberoc',
            'skaal_village' => 'Skaal Village',
            'thirsk'        => 'Thirsk Mead Hall',
            'tel_mithryn'   => 'Tel Mithryn',
            'karstaag'      => 'Castle Karstaag',
            'miraak'        => 'Temple de Miraak',
            'frostmoth'     => 'Fort Frostmoth',
            'kolbjorn'      => 'Tertre de Kolbjorn',
        ],
        'soul_cairn' => [
            'arrival'  => 'Point d’arrivée',
            'boneyard' => 'The Boneyard',
            'reaper'   => 'Reaper’s Lair',
        ],
        'sea'    => 'Mer des Fantômes',
        'throat' => 'Gorge du Monde',
        'towns'  => [
            'solitude'   => 'Solitude',
            'morthal'    => 'Morthal',
            'dawnstar'   => 'Aubétoile',
            'winterhold' => 'Fortdhiver',
            'windhelm'   => 'Vendeaume',
            'whiterun'   => 'Blancherive',
            'markarth'   => 'Markarth',
            'falkreath'  => 'Épervine',
            'riften'     => 'Faillaise',
            'riverwood'  => 'Rivebois',
            'helgen'     => 'Helgen',
            'ivarstead'  => 'Ivarstead',
            'fort_dawnguard'  => 'Fort de la Garde de l’aube',
            'castle_volkihar' => 'Château Volkihar',
        ],
        'title_svg' => 'Carte de Bordeciel avec les joueurs du serveur public',
    ],

    'rules' => [
        'label' => 'Règles de la maison',
        'title' => 'Jouez gentiment',
        'items' => [
            'C’est un monde partagé, et encore jeune : des choses vont se désynchroniser. Signalez-le sur Discord quand ça arrive.',
            'Pas de griefing, pas de harcèlement.',
            'Signalez un crash depuis le lanceur. Signalez une personne sur notre Discord.',
        ],
    ],

    'cta' => [
        'title'   => 'Vous préférez jouer avec votre groupe ?',
        'body'    => 'Hébergez une partie dans le lanceur, envoyez un code de six lettres, et le monde est à vous.',
        'primary' => 'Héberger un serveur',
        'secondary' => 'Télécharger le lanceur',
    ],
];
