<?php

return [

    'meta' => [
        'title'       => 'Installer Skyrim Together VR',
        'description' => 'Installer Skyrim Together VR avec Mod Organizer 2, une liste Wabbajack, Vortex, ou sans gestionnaire. Prérequis, connect.txt, premier lancement et mises à jour.',
    ],

    'hero' => [
        'kicker' => 'Un quart d’heure, surtout du téléchargement',
        'title'  => 'La mise en place',
        'lede'   => 'Choisissez votre façon de gérer vos mods. Le reste est identique pour tout le monde.',
    ],

    'prereq' => [
        'title' => 'D’abord, ce qui n’est pas nous',
        'lede'  => 'Installez tout ceci comme n’importe quel mod SKSE. Si Skyrim VR tourne déjà avec des mods SKSE, l’essentiel est fait.',
        'items' => [
            ['name' => 'Skyrim VR :version',            'note' => 'L’exécutable VR de Steam. Special Edition ne conviendra pas.',                        'state' => 'required'],
            ['name' => 'SKSE VR',                       'note' => 'Dans Data, à côté de Skyrim.esm, comme d’habitude.',                                  'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR', 'note' => 'La table de correspondance que le mod lit pour trouver quoi que ce soit dans le jeu.', 'state' => 'required'],
            ['name' => 'Engine Fixes VR',               'note' => 'Supprime des crashs qui appartiennent au moteur, pas à nous.',                        'state' => 'recommended'],
            ['name' => 'VRIK',                          'note' => 'Donne un corps à votre personnage, et c’est ce corps que votre ami verra bouger.',    'state' => 'recommended'],
        ],
        'ugrids' => 'Un seul réglage compte : <code>uGridsToLoad</code> doit valoir <code>5</code> dans <code>SkyrimPrefs.ini</code>. C’est la valeur par défaut partout, listes Wabbajack comprises, et le serveur refuse toute autre valeur. Avec un nombre de cellules différent, les deux mondes cesseraient discrètement de s’accorder sur ce qui existe.',
    ],

    'methods' => [
        'title' => 'Ensuite, le mod',
        'lede'  => 'Trois chemins vers le même endroit. Mod Organizer 2 est celui qu’utilisent les développeurs.',

        'mo2' => [
            'label' => 'Mod Organizer 2',
            'note'  => 'Et les listes Wabbajack : FUS, Mad God’s Overhaul, la vôtre.',
            'steps' => [
                ['title' => 'Installer le dossier du mod', 'body' => 'Glissez le dossier <code>Skyrim Together mod</code> sur la liste de mods de MO2, ou zippez-le et utilisez <em>Installer un nouveau mod</em>. Cochez-le.'],
                ['title' => 'Activer le plugin',           'body' => 'Cochez <code>SkyrimTogether.esp</code> dans la liste des plugins, à droite.'],
                ['title' => 'Placer le lanceur',           'body' => 'Copiez le dossier <code>Skyrim Together VR</code> dans le dossier <code>tools\\</code> de votre liste. N’importe où fonctionne ; <code>tools\\</code> reste propre.'],
                ['title' => 'L’ajouter comme exécutable',  'body' => 'Dans MO2 : l’engrenage à côté de <em>Run</em> → <strong>+</strong> → <em>Add from file</em> → <code>SkyrimTogetherVR.exe</code>. Appliquez. À partir de là, vous lancez le jeu avec ça, plus avec SKSE.'],
            ],
        ],

        'vortex' => [
            'label' => 'Vortex',
            'note'  => 'Fonctionne très bien. MO2 est simplement ce qui a été testé.',
            'steps' => [
                ['title' => 'Installer les mods SKSE normalement', 'body' => 'SKSE VR, la VR Address Library, Engine Fixes VR et VRIK passent par Vortex comme n’importe quel mod.'],
                ['title' => 'Installer le mod coop',               'body' => 'Zippez le dossier <code>Skyrim Together mod</code> (clic droit → Envoyer vers → Dossier compressé), puis <em>Mods → Install From File</em>, choisissez le zip, activez-le. Cochez <code>SkyrimTogether.esp</code> dans Plugins. Déployez si Vortex le demande.'],
                ['title' => 'Placer le lanceur',                   'body' => 'Mettez le dossier <code>Skyrim Together VR</code> à côté de <code>SkyrimVR.exe</code>. <strong>Pas</strong> dans <code>Data</code>.'],
                ['title' => 'Lancer depuis là',                    'body' => 'Démarrez <code>SkyrimTogetherVR.exe</code> directement, ou ajoutez-le au tableau de bord Vortex avec <em>Add Tool</em>. Ne lancez jamais le loader SKSE vous-même : le lanceur démarre le jeu et charge SKSE pour vous.'],
            ],
            'warnings' => [
                'Le <strong>Purge</strong> de Vortex retire tous les mods déployés de <code>Data</code>, celui-ci compris. Redéployez avant de jouer.',
                'Vortex exige que le jeu et son dossier de staging soient sur le même disque pour les liens physiques. C’est une règle de Vortex, pas la nôtre. Réglez-la là-bas s’il râle.',
            ],
        ],

        'manual' => [
            'label' => 'Sans gestionnaire',
            'note'  => 'Très bien aussi. Il faut juste être le gestionnaire vous-même.',
            'steps' => [
                ['title' => 'Copier le mod',       'body' => 'Tout ce qui est dans <code>Skyrim Together mod</code> va dans <code>Skyrim VR\\Data</code>, à côté de <code>Skyrim.esm</code>. Activez <code>SkyrimTogether.esp</code> dans l’écran Mods du jeu.'],
                ['title' => 'Placer le lanceur',   'body' => 'Mettez le dossier <code>Skyrim Together VR</code> où vous voulez. Dans le dossier de Skyrim VR est un choix raisonnable.'],
                ['title' => 'Lancer depuis là',    'body' => 'Démarrez le jeu avec <code>SkyrimTogetherVR.exe</code> depuis ce dossier, pas avec SKSE. Au premier lancement, il demande où Skyrim VR est installé.'],
            ],
        ],
    ],

    'connect' => [
        'title' => 'Lui indiquer un serveur',
        'lede'  => 'Le client lit un petit fichier texte pour savoir où aller. Vous l’écrivez une fois.',
        'easy'  => 'Le plus simple : double-cliquez sur <code>setup-connect.bat</code> dans le dossier <code>Skyrim Together VR</code> et tapez l’adresse.',
        'manual'=> 'À la main : créez <code>:path</code>, l’adresse sur la première ligne et le mot de passe du serveur, s’il y en a un, sur la deuxième.',
        'table' => [
            'who'  => 'Qui vous êtes',
            'line1'=> 'Ligne 1',
            'line2'=> 'Ligne 2',
            'host' => 'Vous hébergez sur le PC où vous jouez',
            'host1'=> '127.0.0.1::port',
            'friend'=> 'Vous rejoignez quelqu’un',
            'friend1'=> '<son adresse>::port',
            'pass' => 'Le mot de passe, si le serveur en a un',
            'none' => 'Laisser vide',
        ],
        'warning' => 'Juste l’adresse. Pas de <code>http://</code>, pas de guillemets, pas d’espace à la fin.',
    ],

    'first' => [
        'title' => 'Première session',
        'steps' => [
            ['title' => 'Quelqu’un démarre un serveur', 'body' => 'L’hôte lance <code>host-server.bat</code> et laisse la fenêtre ouverte. Si c’est vous, voyez le guide d’hébergement.'],
            ['title' => 'Tout le monde lance le jeu',   'body' => 'Via MO2, via Vortex, ou directement l’exe. Avec une grosse liste de mods, laissez-lui le temps.'],
            ['title' => 'Chargez une sauvegarde',       'body' => 'N’importe laquelle. Cinq secondes plus tard s’affichera <em>Skyrim Together : connexion…</em> puis <em>connecté (build …)</em>. Le groupe se forme seul ; personne n’a à inviter personne.'],
            ['title' => 'Jouez',                        'body' => 'Le tableau de bord SteamVR a un onglet <strong>Skyrim Together</strong> : bouton système, pointeur laser. <code>:key</code> déconnecte et reconnecte sans quitter le jeu.'],
        ],
    ],

    'update' => [
        'label' => 'Rester à jour',
        'title' => 'Mettre à jour',
        'body'  => 'Fermez le jeu. Glissez le zip de mise à jour sur <code>update.bat</code> dans le dossier <code>Skyrim Together VR</code>. Il échange les fichiers sans fermer MO2. À la main, cela revient à remplacer <code>SkyrimTogetherVR.exe</code> et <code>SkyrimTogetherVR.pdb</code>.',
        'warn'  => 'Tout le monde doit être sur la même build, serveur compris. Un écart est refusé à la connexion, et le message nomme les deux versions : vous saurez qui est en retard.',
    ],

    'trouble' => [
        'label' => 'Dépannage',
        'title' => 'Quand ça ne marche pas',
        'lede'  => 'Grosso modo par ordre de fréquence.',
        'items' => [
            ['q' => 'Ça ne se connecte jamais',              'a' => 'Vérifiez <code>connect.txt</code> d’abord : bonne adresse, bon port, rien d’autre sur la ligne. Vérifiez ensuite que la fenêtre du serveur est bien ouverte chez l’hôte. Elle écrit une ligne à chaque connexion.'],
            ['q' => 'Refusé dès la tentative',               'a' => 'C’est volontaire. La notification dit pourquoi : build différente ou mauvais mot de passe. Les builds doivent coïncider exactement, serveur compris.'],
            ['q' => 'Il voit un ours, je vois un loup',      'a' => 'Ordres de chargement différents. Rapprochez les deux listes autant que possible : même liste, même version, mêmes mods optionnels.'],
            ['q' => 'Le jeu plante',                         'a' => 'Lancez <code>collect-logs.bat</code> dans le dossier du lanceur. Il dépose sur votre Bureau un zip avec le log, le crash dump et les versions. Envoyez-le : c’est la différence entre un correctif et une supposition.'],
            ['q' => 'Le jeu démarre sans mes mods SKSE',     'a' => 'Vous avez lancé le loader SKSE au lieu de <code>SkyrimTogetherVR.exe</code>. Le lanceur charge SKSE lui-même. Passez par lui, pas à côté.'],
        ],
    ],

    'cta' => [
        'title' => 'Il faut bien que quelqu’un tienne le serveur',
        'body'  => 'C’est un exécutable et un port UDP, ou aucun port, si vous préférez un réseau virtuel.',
        'primary' => 'Guide d’hébergement',
    ],
];
