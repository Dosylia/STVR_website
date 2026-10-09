<?php

return [

    'meta' => [
        'title'       => 'Montar un servidor multijugador de Skyrim VR · urSovngarde',
        'description' => 'Aloja un servidor cooperativo de Skyrim VR con el lanzador y un código de seis letras, a través de nuestro relay sin abrir ningún puerto, o a mano con redirección del puerto UDP :port o una red virtual.',
    ],

    'hero' => [
        'kicker' => 'Un ejecutable · un puerto UDP · ninguna cuenta',
        'title'  => 'Llevar el servidor',
        'lede'   => 'El servidor es un programa en un PC, y pertenece a quien lo arranca. Sin cuenta, sin sala, sin emparejamiento.',
    ],

    'launcher' => [
        'label' => 'La forma fácil',
        'title' => 'Alojar con el lanzador',
        'steps' => [
            ['title' => 'Pulsa Alojar una partida',          'body' => 'El lanzador arranca el servidor que su instalación dejó junto al mod, espera a que esté funcionando de verdad y muestra un código de seis letras. Antes puedes ponerle una contraseña.'],
            ['title' => 'Manda el código',                   'body' => 'Tus amigos lo escriben en Unirse, en su lanzador, o pulsan Unirse junto a tu nombre en su lista de amigos de Steam.'],
            ['title' => 'Nada que abrir en el router',       'body' => 'Con el lanzador :relay_min o posterior en los dos lados, la partida pasa por un relay nuestro, en marcha desde :relay_since. Es nuevo, así que si un amigo no consigue conectarse, usa una de las dos formas que hay más abajo, en Red.'],
            ['title' => 'Deja de alojar cuando termines',    'body' => 'Eso retira el código y cierra el servidor.'],
        ],
    ],

    'start' => [
        'label' => 'A mano',
        'title' => 'Sin el lanzador',
        'steps' => [
            ['title' => 'Guarda la carpeta Server en algún sitio', 'body' => 'En cualquier parte de la máquina que vaya a alojar. El servidor no necesita el juego, así que un equipo siempre encendido o un portátil viejo valen.'],
            ['title' => 'Ejecuta host-server.bat',                 'body' => 'Se niega a arrancar un segundo servidor, arranca este, e imprime la dirección que hay que repartir. Se abre una consola y dice el puerto.'],
            ['title' => 'Deja la ventana abierta',                 'body' => 'Cerrarla termina la sesión. En Windows 11 puede abrirse como pestaña de un Terminal existente. Si alguna vez ves dos pestañas de servidor, cierra las dos y empieza de nuevo.'],
            ['title' => 'Mira llegar a la gente',                  'body' => 'La consola imprime <em>New player … connected</em>. Es la forma más rápida de saber que una conexión llegó siquiera al servidor.'],
        ],
    ],

    'reach' => [
        'label' => 'Red',
        'title' => 'Dejar que te alcancen',
        'lede'  => 'Con el relay del lanzador, normalmente puedes saltarte esta sección. Cuando no te funcione, hay dos formas, y la segunda es más fácil.',

        'forward' => [
            'label' => 'Redirigir un puerto',
            'body'  => 'Redirige <strong>:protocol :port</strong> en tu router al PC que lleva el servidor, dale a esa máquina una reserva DHCP fija para que la regla no se descoloque, y permítelo en el firewall de Windows. Después reparte tu dirección pública. <code>api.ipify.org</code> te la dirá, y tu operador puede cambiarla al reiniciar el router.',
            'rule'  => 'Una línea en Terminal (como administrador), una sola vez:',
            'cmd'   => 'New-NetFirewallRule -DisplayName "Skyrim Together Server (UDP :port)" -Direction Inbound -Protocol UDP -LocalPort :port -Action Allow -Profile Any',
        ],

        'vpn' => [
            'label' => 'O sáltate el router',
            'body'  => 'Mete a todo el mundo en una red local virtual (Tailscale, ZeroTier o Radmin VPN) y reparte la dirección que te dé. Sin redirección de puertos, sin IP pública, nada expuesto a internet, y sobrevive a que tu operador te cambie la dirección. Para dos o tres amigos, casi siempre es la respuesta correcta.',
        ],

        'self' => 'Alojar en el mismo PC en el que juegas es normal y está previsto. Te conectas a ti mismo en <code>127.0.0.1::port</code>, la misma dirección que todos los demás, sin el viaje.',
    ],

    'settings' => [
        'label' => 'Configuración',
        'title' => 'Ajustes del servidor',
        'lede'  => 'Edita <code>Server\\config\\STServer.ini</code> con el servidor cerrado. Estos son los que merece la pena conocer.',
        'head'  => ['setting' => 'Ajuste', 'default' => 'Por defecto', 'what' => 'Qué hace'],
        'rows'  => [
            ['k' => 'uPort',             'v' => ':port',  'd' => 'El puerto UDP al que se conectan los jugadores. Si lo cambias, cambia también la regla de redirección.'],
            ['k' => 'sPassword',         'v' => 'vacío',  'd' => 'Pon una para dejar fuera a los desconocidos. Los jugadores la escriben en la segunda línea de su connect.txt.'],
            ['k' => 'bAutoPartyCreate',  'v' => 'true',   'd' => 'El primer jugador del servidor recibe un grupo, para que nadie tenga que buscar un menú de grupo en VR.'],
            ['k' => 'bAutoPartyJoin',    'v' => 'true',   'd' => 'Los demás se unen automáticamente. Necesario para compartir clima y misiones.'],
            ['k' => 'bEnablePvp',        'v' => 'false',  'd' => 'Si los jugadores pueden hacerse daño entre ellos. Piensa en tus amistades antes de cambiarlo.'],
            ['k' => 'bEnableDeathSystem','v' => 'true',   'd' => 'Morir te devuelve a un templo en vez de cargar una partida, lo cual desincronizaría el mundo.'],
            ['k' => 'bAllowMO2',         'v' => 'true',   'd' => 'Permite clientes arrancados desde Mod Organizer 2. Déjalo activado.'],
            ['k' => 'bAllowSKSE',        'v' => 'true',   'd' => 'Permite SKSE. Déjalo activado; sin él no funciona nada de esto.'],
            ['k' => 'bEnableModCheck',   'v' => 'false',  'd' => 'Exige listas de mods idénticas byte a byte. Desactivado a propósito. Lo bastante parecido basta.'],
        ],
    ],

    'rules' => [
        'label' => 'Trampas',
        'title' => 'Dos reglas que muerden',
        'items' => [
            ['title' => 'Se conectan las builds que hablan los mismos mensajes', 'body' => 'Sea cual sea su número de versión. Una release que cambia los mensajes de red lo dice, y entonces todo el mundo actualiza, servidor incluido. A un jugador rechazado se le dicen las dos versiones, en el juego y en la pantalla de carga del lanzador.'],
            ['title' => 'uGridsToLoad se queda en 5','body' => 'El servidor rechaza cualquier otro valor. Es el valor por defecto de todas las listas, así que esto solo pilla a quien se haya puesto a tocar.'],
        ],
    ],

    'linux' => [
        'title' => 'Linux',
        'body'  => 'La build de Linux del servidor dedicado no compila con el código actual por ahora. Antes compilaba, y se está arreglando. Mientras tanto, pregunta.',
    ],

    'cta' => [
        'title'   => 'El servidor está en pie. Mete a todo el mundo',
        'body'    => 'Mándales la dirección, la build y la guía de instalación.',
        'primary' => 'Guía de instalación',
        'secondary' => 'Descargar la build',
    ],
];
