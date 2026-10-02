<?php

return [

    'meta' => [
        'title'       => 'Montar un servidor de Skyrim Together VR',
        'description' => 'Lleva tu propio servidor de Skyrim Together VR: redirección del puerto UDP 10578, o una red virtual sin tocar el router. Ajustes, contraseñas y la build de Linux.',
    ],

    'hero' => [
        'kicker' => 'Un ejecutable · un puerto UDP · ninguna cuenta',
        'title'  => 'Llevar el servidor',
        'lede'   => 'El servidor es un programa en un PC. Pertenece a quien lo arranca, y nada tuyo pasa por nadie más.',
    ],

    'start' => [
        'label' => 'El servidor',
        'title' => 'Arrancarlo',
        'steps' => [
            ['title' => 'Guarda la carpeta Server en algún sitio', 'body' => 'En cualquier parte de la máquina que vaya a alojar. El servidor no necesita el juego, así que un equipo siempre encendido o un portátil viejo valen.'],
            ['title' => 'Ejecuta host-server.bat',                 'body' => 'Se niega a arrancar un segundo servidor, arranca este, e imprime la dirección que hay que repartir. Se abre una consola y dice el puerto.'],
            ['title' => 'Deja la ventana abierta',                 'body' => 'Cerrarla termina la sesión. En Windows 11 puede abrirse como pestaña de un Terminal existente — si alguna vez ves dos pestañas de servidor, cierra las dos y empieza de nuevo.'],
            ['title' => 'Mira llegar a la gente',                  'body' => 'La consola imprime <em>New player … connected</em>. Es la forma más rápida de saber que una conexión llegó siquiera al servidor.'],
        ],
    ],

    'reach' => [
        'label' => 'Red',
        'title' => 'Dejar que te alcancen',
        'lede'  => 'Dos formas. La segunda es más fácil y a casi todo el mundo le conviene.',

        'forward' => [
            'label' => 'Redirigir un puerto',
            'body'  => 'Redirige <strong>:protocol :port</strong> en tu router al PC que lleva el servidor, dale a esa máquina una reserva DHCP fija para que la regla no se descoloque, y permítelo en el firewall de Windows. Después reparte tu dirección pública — <code>api.ipify.org</code> te la dirá, y tu operador puede cambiarla al reiniciar el router.',
            'rule'  => 'Una línea en Terminal (como administrador), una sola vez:',
            'cmd'   => 'New-NetFirewallRule -DisplayName "Skyrim Together Server (UDP :port)" -Direction Inbound -Protocol UDP -LocalPort :port -Action Allow -Profile Any',
        ],

        'vpn' => [
            'label' => 'O sáltate el router',
            'body'  => 'Mete a todo el mundo en una red local virtual — Tailscale, ZeroTier o Radmin VPN — y reparte la dirección que te dé. Sin redirección de puertos, sin IP pública, nada expuesto a internet, y sobrevive a que tu operador te cambie la dirección. Para dos o tres amigos, casi siempre es la respuesta correcta.',
        ],

        'self' => 'Alojar en el mismo PC en el que juegas es normal y está previsto. Te conectas a ti mismo en <code>127.0.0.1::port</code> — la misma dirección que todos los demás, sin el viaje.',
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
            ['k' => 'bEnableModCheck',   'v' => 'false',  'd' => 'Exige listas de mods idénticas byte a byte. Desactivado a propósito — lo bastante parecido basta.'],
        ],
    ],

    'rules' => [
        'label' => 'Trampas',
        'title' => 'Dos reglas que muerden',
        'items' => [
            ['title' => 'Todos con la misma build', 'body' => 'Servidor incluido. A un cliente desalineado se le rechaza al conectar y se le dicen los dos números de versión. Cuando una release diga que el servidor ha cambiado, reinicia también el servidor.'],
            ['title' => 'uGridsToLoad se queda en 5','body' => 'El servidor rechaza cualquier otro valor. Es el valor por defecto de todas las listas, así que esto solo pilla a quien se haya puesto a tocar.'],
        ],
    ],

    'linux' => [
        'title' => 'Linux',
        'body'  => 'Existe una build de Linux del servidor dedicado, para quien prefiera tenerlo en una máquina que ya está encendida. Todavía no está en la página de releases — pídela.',
    ],

    'cta' => [
        'title'   => 'El servidor está en pie. Mete a todo el mundo',
        'body'    => 'Mándales la dirección, la build y la guía de instalación.',
        'primary' => 'Guía de instalación',
        'secondary' => 'Descargar la build',
    ],
];
