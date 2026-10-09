<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: privacidad',
        'description' => 'Qué contiene un informe de fallo y cómo se borra a los :days días, qué guardan los códigos de invitación y el relay, y las dos cookies que pone este sitio.',
    ],

    'hero' => [
        'kicker' => 'Informes de fallos, alojamiento y tus datos',
        'title'  => 'Privacidad',
        'lede'   => 'Qué contiene un informe de fallo, qué se guarda cuando alojas a través de nosotros, qué pone este sitio y durante cuánto tiempo.',
    ],

    'discord' => 'nuestro servidor de Discord',

    'sections' => [

        [
            'title' => 'Nada sale sin un sí',
            'body'  => [
                'Cuando el juego se cierra después de un fallo, el lanzador pregunta si puede enviar un informe sobre él. Puedes responder solo para este fallo, sí o no, o una vez para todos: siempre o nunca. Siempre y nunca se pueden cambiar más tarde en los ajustes del lanzador.',
                'Si el juego se cerró mientras estabas con el visor puesto, la pregunta espera a la próxima vez que abras el lanzador. Cerrar la ventana sin responder no envía nada.',
            ],
        ],

        [
            'title' => 'Qué contiene un informe',
            'body'  => ['Solo archivos sobre el fallo, y solo los del último día:'],
            'items' => [
                'El registro del propio mod: a qué se conectó, qué mantuvo sincronizado entre las dos partidas y con qué errores se encontró.',
                'El informe de Crash Logger de cada fallo: en qué punto del código del juego ocurrió, tu lista de plugins y de plugins de SKSE, tu versión de Windows y las piezas de tu PC (procesador, tarjeta gráfica, memoria, modelo de visor).',
                'El registro del servidor, si eras tú quien lo alojaba.',
                'La versión del mod que usabas.',
                'Un volcado de memoria pequeño, de unos pocos megabytes: lo que hacían los hilos del juego en el momento del fallo. Puede contener pequeños fragmentos de lo que el juego tenía en memoria en ese instante.',
                'Tu respuesta a una pregunta: ¿falló mientras jugabas?',
            ],
        ],

        [
            'title' => 'Qué se quita antes',
            'body'  => ['En tu PC, antes de enviar nada, en cada archivo, también en el volcado:'],
            'items' => [
                'Tu nombre de usuario de Windows, allí donde aparezca en una ruta de archivo.',
                'Todas las direcciones IP y las direcciones de servidor.',
                'Tu identificador de Discord.',
                'Los nombres de jugadores y personajes, sustituidos por «Jugador A», «Jugador B», y así sucesivamente.',
            ],
        ],

        [
            'title' => 'Qué no sale nunca de tu PC',
            'items' => [
                'Tus partidas guardadas.',
                'Las capturas de pantalla y las imágenes de cualquier tipo.',
                'Los volcados completos. Ocupan cientos de megabytes y guardan mucha más memoria del juego de la que un informe necesita.',
                'Tus mods, tus archivos de configuración y los archivos de tu lista de mods.',
                'Cualquier cosa que esta página no nombre.',
            ],
        ],

        [
            'title' => 'Por qué preguntamos',
            'body'  => [
                'Un fallo en otro PC, con otra lista de mods, es invisible desde aquí mientras nadie lo envíe. Casi todo lo que se ha arreglado hasta ahora salió del registro de alguien.',
                'De nuestro lado, un programa ordena los informes: agrupa los fallos idénticos y los clasifica según lo a menudo que ocurren y a cuántas personas afectan. Lee registros; no decide nada sobre ti. Los informes sirven para eso y para nada más: ni publicidad, ni rastreo, nada se vende ni se comparte.',
            ],
        ],

        [
            'title' => 'Adónde va y quién lo lee',
            'body'  => [
                'Un informe viaja cifrado (HTTPS) hasta un pequeño servicio nuestro que funciona en Cloudflare, y se guarda allí. Solo pueden leerlo las personas que trabajan en el mod: dos personas hoy.',
                'Como cualquier servidor web, ese servicio ve la dirección desde la que llega un informe. Guarda una huella irreversible de esa dirección (un hash) durante una hora, para contar los informes y frenar los envíos masivos, y nunca la guarda junto al informe.',
                'Cuando llega un informe, se publica una línea corta en un canal privado de :discord: su número, su tamaño, la versión del mod y si falló durante la partida. Nunca su contenido.',
            ],
        ],

        [
            'title' => 'Cuánto tiempo se guarda',
            'body'  => [
                'Cada informe se borra automáticamente :days días después de llegar, en el servicio y en el PC donde se leen los informes.',
            ],
        ],

        [
            'title' => 'Borrar un informe',
            'body'  => [
                'Después de enviarlo, el lanzador muestra el número del informe y guarda la lista de los números que ha enviado. Da un número en :discord y ese informe se borra en todas partes, sin preguntas.',
                'Elige «nunca» en el lanzador y desde ese momento no se envía nada.',
            ],
        ],

        [
            'title' => 'Códigos de invitación',
            'body'  => [
                'Cuando alojas con el lanzador, nuestro hub (el mismo servicio de Cloudflare que recibe los informes) guarda tu dirección pública y tu puerto, si el servidor tiene contraseña (nunca la contraseña en sí), la versión del lanzador y, cuando la hay, la sesión del relay. Los guarda durante :invite_hours horas; el lanzador los renueva cada hora mientras alojas y los retira cuando paras.',
                'Cualquiera que tenga el código obtiene la dirección. Mientras alojas, tus amigos de Steam ven «Hosting urSovngarde», y su lanzador puede leer el código.',
            ],
        ],

        [
            'title' => 'El relay',
            'body'  => [
                'Cuando alojas a través del relay, el tráfico del juego entre tú y tus amigos pasa por un servidor que alquilamos a IONOS, en un centro de datos en Alemania: el mismo servidor que aloja esta web. El tráfico va cifrado por la propia red del juego, y el relay no puede leerlo.',
                'El relay no guarda ninguna dirección en sus registros. Una vez por minuto anota solo recuentos: sesiones, jugadores, paquetes y bytes. Olvida una sesión 60 segundos después de que se quede en silencio.',
            ],
        ],

        [
            'title' => 'Esta web',
            'body'  => [
                'El sitio pone dos cookies, las dos estrictamente necesarias y las dos desaparecen a las dos horas: <code>skyrim-together-vr-session</code>, que el framework del sitio usa para mantener unida una visita, y <code>XSRF-TOKEN</code>, un token de seguridad contra formularios falsificados. No hay rastreo, ni analítica, ni publicidad, y por eso no hay banner de cookies.',
                'Como cualquier servidor web, el nuestro guarda un registro de accesos que anota la dirección y la hora de cada petición.',
            ],
        ],
    ],
];
