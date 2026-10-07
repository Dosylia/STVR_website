<?php

return [

    'meta' => [
        'title'       => 'Instalar urSovngarde',
        'description' => 'Instalar urSovngarde con Mod Organizer 2, una lista de Wabbajack, Vortex o sin gestor de mods. Requisitos, connect.txt, primer arranque y actualizaciones.',
    ],

    'hero' => [
        'kicker' => 'Un cuarto de hora, casi todo descarga',
        'title'  => 'La instalación',
        'lede'   => 'El lanzador lo hace en tres clics. A mano, elige cómo gestionas los mods: el resto es igual para todos.',
    ],

    'launcher' => [
        'label' => 'Lo fácil',
        'title' => 'Deja que lo haga el lanzador',
        'lede'  => 'Descárgalo, ábrelo, pulsa Instalar. Todo lo que viene después de esta sección es lo que hace por ti, para cuando prefieras hacerlo a mano.',
        'steps' => [
            ['title' => 'Descargar el lanzador', 'body' => 'Desde la página de descarga: un pequeño instalador, sin cuenta.'],
            ['title' => 'Abrirlo', 'body' => 'Encuentra Skyrim VR en cualquier biblioteca de Steam, y Mod Organizer 2, Vortex o ningún gestor. Si se equivoca, corrígelo en los ajustes.'],
            ['title' => 'Instalar', 'body' => 'Descarga la versión más reciente y coloca el mod: en Mod Organizer, el mod en tu perfil, su plugin marcado, su lanzador añadido como ejecutable. Después comprueba tu instalación.'],
            ['title' => 'Jugar', 'body' => 'Jugar arranca el juego a través de tu gestor de mods. En Amigos, aloja una partida para obtener un código de seis caracteres, o escribe el de un amigo.'],
        ],
        'cta'   => 'Descargar el lanzador',
    ],

    'prereq' => [
        'title' => 'Primero, lo que no es nuestro',
        'lede'  => 'Instala esto exactamente como cualquier otro mod de SKSE. Si Skyrim VR ya funciona con mods de SKSE, casi todo está hecho.',
        'items' => [
            ['name' => 'Skyrim VR :version',            'note' => 'El ejecutable de VR de Steam. Special Edition no sirve.',                                'state' => 'required'],
            ['name' => 'SKSE VR',                       'note' => 'En Data, junto a Skyrim.esm, como siempre.',                                             'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR', 'note' => 'La tabla que el mod consulta para localizar cualquier cosa dentro del juego.',           'state' => 'required'],
            ['name' => 'Engine Fixes VR',               'note' => 'Elimina cuelgues que son del motor, no nuestros.',                                       'state' => 'recommended'],
            ['name' => 'VRIK',                          'note' => 'Le da cuerpo a tu personaje, y ese es el cuerpo que tu amigo verá moverse.',            'state' => 'recommended'],
        ],
        'ugrids' => 'Solo importa un ajuste: <code>uGridsToLoad</code> debe valer <code>5</code> en <code>SkyrimPrefs.ini</code>. Es el valor por defecto en todas partes, listas de Wabbajack incluidas, y el servidor rechaza cualquier otro. Con un número distinto de celdas cargadas, los dos mundos dejarían de estar de acuerdo, sin avisar, sobre qué existe.',
    ],

    'methods' => [
        'title' => 'Después, el mod',
        'lede'  => 'Tres caminos al mismo sitio. Mod Organizer 2 es el que usan los desarrolladores.',

        'mo2' => [
            'label' => 'Mod Organizer 2',
            'note'  => 'También para listas de Wabbajack: FUS, Mad God’s Overhaul, la tuya.',
            'steps' => [
                ['title' => 'Instalar la carpeta del mod', 'body' => 'Arrastra la carpeta <code>Skyrim Together mod</code> a la lista de mods de MO2, o comprímela y usa <em>Install a new mod</em>. Márcala.'],
                ['title' => 'Activar el plugin',           'body' => 'Marca <code>SkyrimTogether.esp</code> en la lista de plugins de la derecha.'],
                ['title' => 'Colocar el lanzador',         'body' => 'Copia la carpeta <code>Skyrim Together VR</code> en la carpeta <code>tools\\</code> de tu lista. Vale cualquier sitio; <code>tools\\</code> lo mantiene ordenado.'],
                ['title' => 'Añadirlo como ejecutable',    'body' => 'En MO2: el engranaje junto a <em>Run</em> → <strong>+</strong> → <em>Add from file</em> → <code>SkyrimTogetherVR.exe</code>. Aplica. A partir de ahí arrancas el juego con eso, no con SKSE.'],
            ],
        ],

        'vortex' => [
            'label' => 'Vortex',
            'note'  => 'Funciona perfectamente. MO2 es simplemente lo que se ha probado.',
            'steps' => [
                ['title' => 'Instalar los mods de SKSE normalmente', 'body' => 'SKSE VR, la VR Address Library, Engine Fixes VR y VRIK entran por Vortex como cualquier otro mod.'],
                ['title' => 'Instalar el mod cooperativo',           'body' => 'Comprime la carpeta <code>Skyrim Together mod</code> (clic derecho → Enviar a → Carpeta comprimida), luego <em>Mods → Install From File</em>, elige el zip y actívalo. Marca <code>SkyrimTogether.esp</code> en Plugins. Despliega si Vortex lo pide.'],
                ['title' => 'Colocar el lanzador',                   'body' => 'Pon la carpeta <code>Skyrim Together VR</code> junto a <code>SkyrimVR.exe</code>. <strong>No</strong> dentro de <code>Data</code>.'],
                ['title' => 'Arrancar desde ahí',                    'body' => 'Ejecuta <code>SkyrimTogetherVR.exe</code> directamente, o añádelo al panel de Vortex con <em>Add Tool</em>. No arranques nunca el loader de SKSE por tu cuenta: el lanzador arranca el juego y carga SKSE por ti.'],
            ],
            'warnings' => [
                'El <strong>Purge</strong> de Vortex saca de <code>Data</code> todos los mods desplegados, este incluido. Vuelve a desplegar antes de jugar.',
                'Vortex necesita el juego y su carpeta de staging en la misma unidad para los enlaces físicos. Es una regla de Vortex, no nuestra. Arréglalo ahí si protesta.',
            ],
        ],

        'manual' => [
            'label' => 'Sin gestor de mods',
            'note'  => 'Perfectamente válido. Solo tienes que ser tú el gestor de mods.',
            'steps' => [
                ['title' => 'Copiar el mod',        'body' => 'Todo lo que hay dentro de <code>Skyrim Together mod</code> va a <code>Skyrim VR\\Data</code>, junto a <code>Skyrim.esm</code>. Activa <code>SkyrimTogether.esp</code> en la pantalla de Mods del juego.'],
                ['title' => 'Colocar el lanzador',  'body' => 'Pon la carpeta <code>Skyrim Together VR</code> donde quieras. Dentro de la carpeta de Skyrim VR es un sitio razonable.'],
                ['title' => 'Arrancar desde ahí',   'body' => 'Arranca el juego con <code>SkyrimTogetherVR.exe</code> desde esa carpeta, no con SKSE. La primera vez te preguntará dónde está instalado Skyrim VR.'],
            ],
        ],
    ],

    'connect' => [
        'title' => 'Apuntarlo a un servidor',
        'lede'  => 'El cliente lee un pequeño archivo de texto para saber a dónde ir. Lo escribes una vez.',
        'easy'  => 'Lo fácil: doble clic en <code>setup-connect.bat</code> dentro de la carpeta <code>Skyrim Together VR</code> y escribe la dirección.',
        'manual'=> 'A mano: crea <code>:path</code>, con la dirección en la primera línea y la contraseña del servidor, si la hay, en la segunda.',
        'table' => [
            'who'  => 'Quién eres',
            'line1'=> 'Línea 1',
            'line2'=> 'Línea 2',
            'host' => 'Alojas en el mismo PC en el que juegas',
            'host1'=> '127.0.0.1::port',
            'friend'=> 'Te unes a otra persona',
            'friend1'=> '<su dirección>::port',
            'pass' => 'La contraseña, si el servidor tiene una',
            'none' => 'Dejar vacía',
        ],
        'warning' => 'Solo la dirección. Sin <code>http://</code>, sin comillas, sin espacios al final.',
    ],

    'first' => [
        'title' => 'Primera sesión',
        'steps' => [
            ['title' => 'Alguien arranca un servidor', 'body' => 'El anfitrión ejecuta <code>host-server.bat</code> y deja la ventana abierta. Si eres tú, mira la guía de alojamiento.'],
            ['title' => 'Todos arrancan el juego',     'body' => 'Por MO2, por Vortex o directamente el exe. Con una lista de mods pesada, dale tiempo.'],
            ['title' => 'Cargad una partida',          'body' => 'Cualquiera. Unos cinco segundos después verás <em>Skyrim Together: connecting…</em> y luego <em>connected (build …)</em>. El grupo se forma solo; nadie tiene que invitar a nadie.'],
            ['title' => 'A jugar',                     'body' => 'El panel de SteamVR tiene una pestaña <strong>Skyrim Together</strong>: botón de sistema, puntero láser. <code>:key</code> desconecta y vuelve a conectar sin salir del juego.'],
        ],
    ],

    'update' => [
        'label' => 'Mantenerse al día',
        'title' => 'Actualizar',
        'body'  => 'Cierra el juego. Arrastra el zip de actualización sobre <code>update.bat</code> en la carpeta <code>Skyrim Together VR</code>. Cambia los archivos sin cerrar MO2. A mano, eso es sustituir <code>SkyrimTogetherVR.exe</code> y <code>SkyrimTogetherVR.pdb</code>.',
        'warn'  => 'Todos tenéis que estar en la misma build, servidor incluido. Una diferencia se rechaza al conectar, y el mensaje nombra las dos versiones, así que sabrás quién va por detrás.',
    ],

    'trouble' => [
        'label' => 'Resolución de problemas',
        'title' => 'Cuando no funciona',
        'lede'  => 'Más o menos por orden de frecuencia.',
        'items' => [
            ['q' => 'No se conecta nunca',                  'a' => 'Mira primero <code>connect.txt</code>: dirección correcta, puerto correcto, nada más en la línea. Después comprueba que la ventana del servidor está realmente abierta en el PC del anfitrión. Escribe una línea cada vez que alguien se conecta.'],
            ['q' => 'Rechazado nada más intentarlo',        'a' => 'Es deliberado. El aviso dice por qué: build distinta o contraseña incorrecta. Las builds deben coincidir exactamente, servidor incluido.'],
            ['q' => 'Él ve un oso, yo veo un lobo',         'a' => 'Órdenes de carga distintos. Acerca las dos listas todo lo que puedas: misma lista, misma versión, mismos mods opcionales.'],
            ['q' => 'El juego se cuelga',                   'a' => 'Ejecuta <code>collect-logs.bat</code> en la carpeta del lanzador. Deja un zip en tu Escritorio con el registro, el volcado y las versiones. Mándalo: es la diferencia entre un arreglo y una suposición.'],
            ['q' => 'Arranca sin mis mods de SKSE',         'a' => 'Has arrancado el loader de SKSE en vez de <code>SkyrimTogetherVR.exe</code>. El lanzador carga SKSE él mismo. Pasa por él, no por al lado.'],
        ],
    ],

    'cta' => [
        'title' => 'Alguien tiene que llevar el servidor',
        'body'  => 'Es un ejecutable y un puerto UDP, o ningún puerto, si prefieres una red virtual.',
        'primary' => 'Guía de alojamiento',
    ],
];
