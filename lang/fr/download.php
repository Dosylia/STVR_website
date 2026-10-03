<?php

return [

    'meta' => [
        'title'       => 'Télécharger Skyrim Together VR',
        'description' => 'Récupérez la dernière build de Skyrim Together VR : le paquet complet pour une première installation, ou le petit zip de mise à jour si vous l’avez déjà.',
    ],

    'hero' => [
        'kicker' => 'Gratuit · GPLv3 · sans compte',
        'title'  => 'Prenez la build',
        'lede'   => 'Deux fichiers. Le gros la première fois, le petit toutes les fois suivantes.',
    ],

    'release' => [
        'label'          => 'La build',
        'live_label'     => 'Dernière version',
        'current'        => 'La build actuelle',
        'published'      => 'Publiée le :date',
        'unknown_date'   => 'Toute fraîche',
        'downloads'      => ':count téléchargements',
        'notes'          => 'Notes de version',
        'notes_on_github'=> 'Notes complètes sur GitHub',
        'mirror'         => 'Toutes les versions',
    ],

    'state' => [
        'fallback_title' => 'Servie depuis GitHub',
        'fallback_body'  => 'La build la plus récente est toujours sur la page des releases. Ce panneau se remplira tout seul (version, date, taille) dès qu’une release sera publiée.',
        'none_title'     => 'La première build publique est en préparation',
        'none_body'      => 'Rien à télécharger ici pour l’instant. Le code est public entre-temps, et c’est dans le journal que le travail apparaît en premier.',
    ],

    'assets' => [
        'full' => [
            'title' => 'Paquet complet',
            'body'  => 'Tout : le dossier du mod, le lanceur, le serveur et les quatre guides d’installation. C’est celui qu’il vous faut la première fois.',
            'meta'  => 'Première installation',
        ],
        'patch' => [
            'title' => 'Mise à jour seule',
            'body'  => 'Seulement l’exécutable client et ses symboles. Glissez-le sur update.bat dans votre dossier lanceur, et c’est fini. Assez petit pour tenir dans un message.',
            'meta'  => 'Déjà installé',
        ],
        'server' => [
            'title' => 'Serveur',
            'body'  => 'Le serveur dédié seul, pour une machine qui n’a pas le jeu. Une build Linux existe aussi. Demandez-la.',
            'meta'  => 'Pour les hôtes',
        ],
        'download_cta' => 'Télécharger',
        'size'         => 'Taille',
    ],

    'requires' => [
        'label' => 'Prérequis',
        'title' => 'Avant de cliquer',
        'lede'  => 'Rien de tout ceci n’est facultatif, sauf là où c’est écrit.',
        'items' => [
            ['name' => 'Skyrim VR :version',             'note' => 'La version Steam. Pas Special Edition, pas Anniversary : l’exécutable VR.', 'state' => 'required'],
            ['name' => 'SKSE VR',                        'note' => 'La version VR du script extender. Dans Data, comme tout mod SKSE.',          'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR',  'note' => 'Ce qui permet au mod de trouver quoi que ce soit dans le jeu.',               'state' => 'required'],
            ['name' => 'uGridsToLoad = 5',               'note' => 'La valeur par défaut. Le serveur refuse les autres : les deux mondes ne coïncideraient plus.', 'state' => 'required'],
            ['name' => 'Engine Fixes VR',                'note' => 'Supprime une catégorie de crash qui n’a rien à voir avec nous.',              'state' => 'recommended'],
            ['name' => 'VRIK',                           'note' => 'Le corps que votre ami voit. Vivement conseillé. C’est l’essentiel de l’intérêt.', 'state' => 'recommended'],
            ['name' => 'La même build que vos amis',     'note' => 'Le serveur refuse les écarts et affiche les deux versions quand il le fait.', 'state' => 'required'],
        ],
    ],

    'next' => [
        'label' => 'Ensuite',
        'title' => 'Téléchargé. Et maintenant',
        'install' => ['title' => 'L’installer',        'body' => 'MO2, Vortex, une liste Wabbajack ou aucun gestionnaire. Le guide couvre les quatre cas.', 'cta' => 'Guide d’installation'],
        'host'    => ['title' => 'L’héberger',         'body' => 'Un exécutable, un port UDP, ou un réseau virtuel et pas de box du tout.',                'cta' => 'Guide d’hébergement'],
        'issues'  => ['title' => 'Quand ça casse',     'body' => 'Lancez collect-logs.bat et envoyez le zip. Il contient le log, le dump et les versions.', 'cta' => 'Signaler un bug'],
    ],

    'safety' => [
        'label' => 'Confiance',
        'title' => 'Un mot sur la confiance',
        'body'  => 'Le lanceur remplace l’exécutable du jeu en mémoire pour faire son travail, ce qui est exactement la forme d’une chose dont il faut se méfier. Donc : chaque ligne est sur GitHub, la licence impose que cela reste ainsi, et la build que vous téléchargez est produite par un script du même dépôt. Si vous préférez la compiler vous-même, c’est une réponse parfaitement valable.',
        'cta'   => 'Lire le code',
    ],
];
