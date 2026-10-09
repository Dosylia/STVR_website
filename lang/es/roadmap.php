<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: hoja de ruta y fallos conocidos',
        'description' => 'Las seis cosas que se están arreglando, en el orden en que merece la pena arreglarlas, y una lista honesta de lo que se rompe hoy.',
    ],

    'hero' => [
        'kicker' => 'Seis objetivos · en orden',
        'title'  => 'Qué viene, y qué está roto',
        'lede'   => 'Esta es la lista de verdad, en el orden de verdad. Nada se marca como hecho por haberse escrito; las cosas salen de ella cuando quienes juegan dejan de reportarlas.',
    ],

    'constellation' => [
        'label' => 'El camino',
        'title' => 'Las seis',
        'lede'  => 'Ordenadas por lo que conviene arreglar antes, no por lo que es más fácil. Todo lo demás se mide contra esta lista.',
        'legend' => [
            'active' => 'En curso',
            'next'   => 'Lo siguiente',
            'later'  => 'Después',
        ],
        'goals' => [
            [
                'n' => 1,
                'state' => 'active',
                'title' => 'No más cuelgues',
                'body'  => 'Todo lo demás es decoración si la sesión termina a los veinte minutos. La mayor parte del trabajo de este mes ha ido aquí: comprobaciones de nulos en cada hook, rutas de destrucción que ya no entregan un actor borrado a código que todavía lo sostiene, y una herramienta de volcados que nombra la función en vez de invitar a adivinar.',
            ],
            [
                'n' => 2,
                'state' => 'active',
                'title' => 'El mundo, idéntico en los dos visores',
                'body'  => 'Si tú lo mataste, para él también está muerto; si él saqueó el cofre, para ti está vacío. Lo que queda son los límites de celda. Cruzarlos deprisa es de donde vienen los informes más extraños.',
            ],
            [
                'n' => 3,
                'state' => 'next',
                'title' => 'Las interacciones de VRIK, vistas por todos',
                'body'  => 'La VR tiene gestos que un juego plano nunca tuvo: alcanzar por encima del hombro, enfundar en la cadera, coger algo del aire. Son los que hacen que un cuerpo se lea como una persona, y tienen que cruzar la red tal cual, no como la animación más parecida que haya a mano.',
            ],
            [
                'n' => 4,
                'state' => 'active',
                'title' => 'Cuerpos que se quedan donde los dejas',
                'body'  => 'Arrastrar un cadáver funciona, y lo ven los dos jugadores. Un cadáver ya yace en el mismo sitio en los dos mundos. Queda por hacer: el cuerpo de otro jugador y los PNJ vivos.',
            ],
            [
                'n' => 5,
                'state' => 'later',
                'title' => 'Nadie bajo el suelo',
                'body'  => 'Los PNJ a veces aparecen por debajo del suelo en el que deberían estar. Están sincronizados, solo que sincronizados a la altura equivocada.',
            ],
            [
                'n' => 6,
                'state' => 'active',
                'title' => 'Los golpes caen donde está el arma',
                'body'  => 'Cuando dos hojas se encuentran, los dos jugadores lo sienten, lo oyen y lo ven, y es la pantalla de quien defiende la que decide si un golpe se paró. A partir de la próxima release, solo un arma o un escudo paran un golpe. Lo siguiente: hojas que se frenan físicamente la una a la otra.',
            ],
        ],
    ],

    'issues' => [
        'label' => 'Hoy',
        'title' => 'Fallos conocidos',
        'lede'  => 'Al día, concretos, y no una formalidad. Si te encuentras algo que no esté aquí, es genuinamente nuevo. Manda el registro.',
        'items' => [
            [
                'title' => 'Sigue colgándose',
                'body'  => 'Menos que antes, y lo que queda gira sobre todo en torno a muchos actores destruidos a la vez. <code>collect-logs.bat</code> nos da el volcado, y el volcado nombra la función.',
            ],
            [
                'title' => 'Cruzar celdas deprisa se pone raro',
                'body'  => 'Un bandido lanzado al cielo, un cadáver en el sitio equivocado, una spriggan cuyos golpes no llegan nunca, todo reportado mientras se cruzaba el país a la carrera, que es el hilo del que se está tirando ahora.',
            ],
            [
                'title' => 'PNJ por debajo del nivel del suelo',
                'body'  => 'Sincronizados correctamente, en el sitio equivocado. Normalmente cosmético, de vez en cuando fatal para un combate.',
            ],
            [
                'title' => 'Los cuerpos movidos aún pueden no coincidir',
                'body'  => 'Un cadáver ya yace en el mismo sitio en los dos mundos, y cuando alguien arrastra uno, lo ven los dos jugadores. El cuerpo de otro jugador, y los PNJ vivos cuando se les mueve, todavía pueden acabar en sitios distintos.',
            ],
            [
                'title' => 'El PvP es joven',
                'body'  => 'Las paradas son nuevas. El 8 y el 9 de octubre se encontraron tres formas en que un golpe atravesaba una parada, y las tres están arregladas para la próxima release. En una de las dos partidas, la copia del otro jugador a veces no lleva arma, y entonces no se le puede parar.',
            ],
            [
                'title' => 'Alojar a través del relay es nuevo',
                'body'  => 'En marcha desde :relay_since, y todavía sin probar durante una sesión completa. Si un amigo no consigue conectarse, redirige el puerto o usa Tailscale, como en la página del servidor.',
            ],
            [
                'title' => 'Vortex anterior a :vortex_min',
                'body'  => 'El lanzador copia los archivos en Data, como antes, y no aparecen en la lista de mods de Vortex. Actualizar Vortex lo arregla.',
            ],
            [
                'title' => 'Los acompañantes pueden quedarse muy atrás',
                'body'  => 'Viaja deprisa y tu seguidor puede quedarse varias celdas atrás. El cliente está soltando actores en celdas que el juego descargó: comportamiento correcto con un resultado que no lo parece.',
            ],
        ],
        'report' => [
            'title' => 'Si encuentras uno nuevo',
            'body'  => 'Ejecuta <code>collect-logs.bat</code> en la carpeta del lanzador. Deja un zip en tu Escritorio con el registro del cliente, el volcado si lo hay y las dos versiones de build. Ese zip es la diferencia entre un arreglo esta semana y una teoría este mes.',
            'cta'   => 'Abrir una incidencia',
        ],
    ],

    'done' => [
        'label' => 'Detrás',
        'title' => 'Fuera de la lista últimamente',
        'lede'  => 'No es un changelog. El diario hace de changelog. Solo la forma de las últimas semanas.',
        'items' => [
            'Un lanzador: instalar, comprobar, jugar, alojar y unirse con un código.',
            'Alojar sin abrir ningún puerto, a través de un relay nuestro.',
            'Cuando dos hojas se encuentran, los dos jugadores lo sienten, lo oyen y lo ven.',
            'Una seguidora pertenece a la partida del jugador al que sigue.',
            'Un cadáver yace en el mismo sitio en los dos mundos.',
            'Volcados de fallo lo bastante pequeños como para enviarlos.',
            'Pruebas con bot sin supervisión: una regresión la encuentra una máquina de madrugada en vez de un amigo un viernes.',
        ],
    ],

    'cta' => [
        'title'   => 'Lee cómo fue en realidad',
        'body'    => 'El diario también lleva dentro los caminos equivocados.',
        'primary' => 'Abrir el diario',
    ],
];
