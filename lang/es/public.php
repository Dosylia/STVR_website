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
            ['title' => 'Ten la misma build',      'body' => 'El servidor lleva la build :version. Se conectan las builds que hablan los mismos mensajes, así que una versión cercana a menudo también vale; si rechazan la tuya, el lanzador te dice las dos versiones y en la página de descarga está la buena.'],
            ['title' => 'Pon la dirección',        'body' => 'En el lanzador, abre Unirse, elige "o una dirección" y pega la dirección de arriba. Sin el lanzador, ponla en la primera línea de tu connect.txt.'],
            ['title' => 'Carga cualquier partida', 'body' => 'El juego se une al servidor unos segundos después de cargar la partida. Tu personaje y tu partida siguen siendo tuyos.'],
        ],
        'copy' => 'Copiar la dirección',
    ],

    'who' => [
        'label' => 'En el servidor',
        'title' => 'Quién está',
        'none'  => 'Ahora mismo no hay nadie. Sé el primero.',
        'inside' => 'En un interior',
        'note'  => 'Nombres de personaje, tal como los jugadores los pusieron en el juego. En un interior, el jugador aparece en la lista sin lugar en el mapa.',
    ],

    'map' => [
        'label'  => 'Dónde están',
        'title'  => 'El mapa',
        'note'   => 'Se actualiza cada :seconds segundos, no en directo. Es nuestro propio dibujo de Skyrim, lo bastante preciso para decir "cerca de Cauce Boscoso".',
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
