<?php

return [

    'meta' => [
        'title'       => 'Servidor público de Skyrim VR · urSovngarde',
        'description' => 'Un servidor de urSovngarde al que puede unirse cualquiera: quién está conectado ahora mismo, dónde está en el mapa y cómo entrar.',
    ],

    'hero' => [
        'kicker' => 'Abierto a todos · sin código de invitación',
        'title'  => 'El servidor público',
        'lede'   => 'Un servidor que mantenemos en marcha para cualquiera que tenga el mod. Mira quién está, dónde anda, y únete.',
    ],

    // Shown instead of everything below while the server or its status is not live.
    'closed' => [
        'title' => 'Todavía no está abierto',
        'body'  => 'El servidor público está en construcción. Hasta que abra, juega con tus amigos: aloja una partida en el lanzador y mándales su código de seis letras.',
        'cta'   => 'Aloja el tuyo',
        'sample' => 'Vista previa de desarrollo: el servidor de esta página es inventado.',
    ],

    'status' => [
        'label'    => 'Ahora mismo',
        'online'   => 'En línea',
        'offline'  => 'Desconectado',
        'offline_body' => 'El servidor no responde en este momento. Puede que se esté reiniciando por una actualización; vuelve a mirar dentro de unos minutos.',
        'players'  => 'Jugadores',
        'of'       => ':count de :max',
        'address'  => 'Dirección',
        'version'  => 'Build',
        'protocol' => 'Conjunto de mensajes',
        'password' => 'Contraseña',
        'password_yes' => 'Sí, pídela en Discord',
        'password_no'  => 'Ninguna',
        'up_since' => 'En marcha desde',
        'updated'  => 'Estado del :time',
    ],

    'join' => [
        'label' => 'Unirse',
        'title' => 'Cómo unirte',
        'steps' => [
            ['title' => 'Ten una build que hable sus mensajes', 'body' => 'El servidor lleva la build :version, conjunto de mensajes :protocol. Se conecta cualquier build con el mismo conjunto de mensajes, así que una versión cercana a menudo también vale. Si rechazan la tuya, el lanzador te dice las dos versiones, y en la página de descarga está la buena.'],
            ['title' => 'Pon la dirección',        'body' => 'En el lanzador, abre Unirse, elige "o una dirección" y pega la dirección de arriba. Sin el lanzador, ponla en la primera línea de tu connect.txt.'],
            ['title' => 'Carga cualquier partida', 'body' => 'El juego se une al servidor unos segundos después de cargar la partida. Tu personaje y tu partida siguen siendo tuyos.'],
        ],
        'copy' => 'Copiar la dirección',
        'button' => 'Unirse con el lanzador',
        'button_note' => 'El lanzador pregunta antes de unirse. Si no pasa nada, actualiza el lanzador: las versiones antiguas no conocen este enlace.',
    ],

    'who' => [
        'label' => 'En el servidor',
        'title' => 'Quién está',
        'none'  => 'Ahora mismo no hay nadie. Sé el primero.',
        'inside' => 'En un interior',
        'note'  => 'Nombres de personaje, tal como los jugadores los pusieron en el juego, y lugares en el idioma en que cada jugador tiene su propio juego. En un interior, el jugador aparece en la lista sin punto en el mapa.',
        'hidden' => '{1} Y un jugador más que no aparece en la lista.|[2,*] Y :count jugadores más que no aparecen en la lista.',
        'hide' => '¿Prefieres no aparecer aquí? En el lanzador: «Ocultarme de la página del servidor público».',
    ],

    'map' => [
        'label'  => 'Dónde están',
        'title'  => 'El mapa',
        'note'   => 'Se actualiza cada :seconds segundos mientras miras. Son nuestros propios dibujos, lo bastante precisos para decir "cerca de Cauce Boscoso".',
        'switch' => 'Elige un mapa',
        'title_solstheim' => 'Mapa de Solstheim con los jugadores del servidor público',
        'title_soul_cairn' => 'Mapa del Recordatorio de las Almas con los jugadores del servidor público',
        'red_mountain' => 'Montaña Roja',
        // The areas a player can be outdoors in (config stvr.public_server.areas). Skyrim and Solstheim have a map.
        'areas'  => [
            'skyrim'         => 'Skyrim',
            'solstheim'      => 'Solstheim',
            'blackreach'     => 'Blackreach',
            'sovngarde'      => 'Sovngarde',
            'skuldafn'       => 'Skuldafn',
            'soul_cairn'     => 'Recordatorio de las Almas',
            'forgotten_vale' => 'Valle Olvidado',
            'apocrypha'      => 'Apocrypha',
            'deepwood_vale'  => 'Deepwood Vale',
        ],
        'solstheim' => [
            'raven_rock'    => 'Roca del Cuervo',
            'skaal_village' => 'Aldea Skaal',
            'thirsk'        => 'Salón del aguamiel de Thirsk',
            'tel_mithryn'   => 'Tel Mithryn',
            'karstaag'      => 'Castillo de Karstaag',
            'miraak'        => 'Templo de Miraak',
            'frostmoth'     => 'Fuerte Polilla Helada',
            'kolbjorn'      => 'Túmulo de Kolbjorn',
        ],
        'soul_cairn' => [
            'arrival'  => 'Donde llegas',
            'boneyard' => 'El Osario',
            'reaper'   => 'Reaper\'s Lair',
        ],
        'sea'    => 'Mar de los Fantasmas',
        'throat' => 'Garganta del Mundo',
        'towns'  => [
            'solitude'   => 'Soledad',
            'morthal'    => 'Morthal',
            'dawnstar'   => 'Amanecer',
            'winterhold' => 'Hibernalia',
            'windhelm'   => 'Ventalia',
            'whiterun'   => 'Carrera Blanca',
            'markarth'   => 'Markarth',
            'falkreath'  => 'Falkreath',
            'riften'     => 'Riften',
            'riverwood'  => 'Cauce Boscoso',
            'helgen'     => 'Helgen',
            'ivarstead'  => 'Ivarstead',
            'fort_dawnguard'  => 'Fuerte Guardia del Alba',
            'castle_volkihar' => 'Castillo Volkihar',
        ],
        'title_svg' => 'Mapa de Skyrim con los jugadores del servidor público',
    ],

    'rules' => [
        'label' => 'Normas de la casa',
        'title' => 'Juega limpio',
        'items' => [
            'Es un mundo compartido, y todavía temprano: las cosas se irán desincronizando. Cuando pase, dilo en Discord.',
            'Nada de griefing ni de acoso.',
            'Los cierres del juego se informan desde el lanzador. A las personas, en nuestro Discord.',
        ],
    ],

    'cta' => [
        'title'   => '¿Prefieres jugar con tu propio grupo?',
        'body'    => 'Aloja una partida en el lanzador, manda un código de seis letras y el mundo es tuyo.',
        'primary' => 'Alojar un servidor',
        'secondary' => 'Descargar el lanzador',
    ],
];
