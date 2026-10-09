<?php

return [

    'meta' => [
        'title'       => 'Descargar el mod multijugador de Skyrim VR · urSovngarde',
        'description' => 'Descarga urSovngarde, el mod cooperativo y multijugador gratuito para Skyrim VR: el lanzador, el paquete completo para la primera instalación, o el zip pequeño de actualización.',
    ],

    'hero' => [
        'kicker' => 'Gratis · GPLv3 · sin cuenta',
        'title'  => 'Llévate el lanzador',
        'lede'   => 'Un pequeño programa instala el mod, comprueba tu instalación, arranca el juego y hace entrar a tus amigos. Los paquetes para instalar a mano están debajo.',
    ],

    'release' => [
        'label'          => 'La build',
        'live_label'     => 'Última versión',
        'current'        => 'La build actual',
        'published'      => 'Publicada el :date',
        'unknown_date'   => 'Recién salida',
        'downloads'      => ':count descargas',
        'notes'          => 'Notas de la versión',
        'notes_on_github'=> 'Notas completas en GitHub',
        'mirror'         => 'Todas las versiones',
    ],

    'state' => [
        'fallback_title' => 'Servida desde GitHub',
        'fallback_body'  => 'La build más reciente está siempre en la página de releases. Este panel se rellenará con versión, fecha y tamaño en cuanto se publique una release etiquetada.',
        'none_title'     => 'La primera build pública se está empaquetando',
        'none_body'      => 'Aquí todavía no hay nada que descargar. Mientras tanto el código es público, y el diario es donde el trabajo aparece primero.',
    ],

    'assets' => [
        'launcher' => [
            'title' => 'Lanzador de urSovngarde',
            'body'  => 'Encuentra Skyrim VR y tu gestor de mods, instala y actualiza el mod, comprueba tu instalación contra cada trampa que conocemos, arranca el juego y se une a tus amigos con un código de seis caracteres. Para Windows 10 y 11.',
            'meta'  => 'Empieza aquí',
            'works_with' => 'Funciona con',
            'setups' => ['Mod Organizer 2', 'Vortex', 'Sin gestor de mods'],
            'version' => 'Versión :version',
            'updated' => 'Actualizado el :date',
            'soon'  => 'Aún no publicado',
            'soon_note' => 'El lanzador aún está en pruebas. Este botón lo descargará en cuanto se publique.',
        ],
        'by_hand' => 'A mano',
        'full' => [
            'title' => 'Paquete completo',
            'body'  => 'Todo, para instalar a mano: la carpeta del mod, su propio lanzador, el servidor y las cuatro guías de instalación. El lanzador de urSovngarde descarga este mismo paquete por ti.',
            'meta'  => 'Primera instalación',
        ],
        'patch' => [
            'title' => 'Solo actualización',
            'body'  => 'Solo el ejecutable del cliente y sus símbolos. Arrástralo sobre update.bat en tu carpeta del lanzador y listo. Lo bastante pequeño para mandarlo por chat.',
            'meta'  => 'Ya instalado',
        ],
        'server' => [
            'title' => 'Servidor',
            'body'  => 'El servidor dedicado por separado, para una máquina que no tiene el juego. También existe una build de Linux. Pídela.',
            'meta'  => 'Solo anfitriones',
        ],
        'download_cta' => 'Descargar',
        'size'         => 'Tamaño',
    ],

    'requires' => [
        'label' => 'Requisitos',
        'title' => 'Antes de pulsar',
        'lede'  => 'Nada de esto es opcional, salvo donde lo pone.',
        'items' => [
            ['name' => 'Skyrim VR :version',              'note' => 'La versión de Steam. No Special Edition, no Anniversary: el ejecutable de VR.',  'state' => 'required'],
            ['name' => 'SKSE VR',                         'note' => 'La build de VR del script extender. En Data, como cualquier mod de SKSE.',        'state' => 'required'],
            ['name' => 'VR Address Library for SKSEVR',   'note' => 'Lo que permite que el mod encuentre algo dentro del juego.',                      'state' => 'required'],
            ['name' => 'uGridsToLoad = 5',                'note' => 'El valor por defecto. El servidor rechaza cualquier otro: los dos mundos dejarían de cuadrar.', 'state' => 'required'],
            ['name' => 'Engine Fixes VR',                 'note' => 'Elimina una categoría de cuelgues que no tiene nada que ver con nosotros.',       'state' => 'recommended'],
            ['name' => 'VRIK',                            'note' => 'El cuerpo que ve tu amigo. Muy recomendable. Es casi todo el sentido de esto.',  'state' => 'recommended'],
            ['name' => 'La misma build que tus amigos',   'note' => 'El servidor rechaza las diferencias y nombra las dos versiones al hacerlo.',      'state' => 'required'],
        ],
    ],

    'next' => [
        'label' => 'Y ahora',
        'title' => 'Descargado. ¿Y ahora qué?',
        'install' => ['title' => 'Instalarlo',       'body' => 'MO2, Vortex, una lista de Wabbajack o ningún gestor. La guía cubre los cuatro casos.', 'cta' => 'Guía de instalación'],
        'host'    => ['title' => 'Alojarlo',         'body' => 'Un ejecutable, un puerto UDP, o una red virtual y ningún router.',                     'cta' => 'Guía de alojamiento'],
        'issues'  => ['title' => 'Cuando se rompa',  'body' => 'Tras un fallo, el lanzador pregunta si puede enviar un informe, quitando antes tus nombres y direcciones. Sin él: ejecuta collect-logs.bat y manda el zip.', 'cta' => 'Reportar un fallo'],
    ],

    'safety' => [
        'label' => 'Confianza',
        'title' => 'Una nota sobre la confianza',
        'body'  => 'El lanzador propio del mod (SkyrimTogetherVR.exe) sustituye el ejecutable del juego en memoria para hacer su trabajo, que es exactamente la forma de algo de lo que deberías desconfiar. Así que: cada línea está en GitHub, la licencia obliga a que siga siendo así, y la build que descargas la produce un script de ese mismo repositorio. Si prefieres compilarla tú, esa es una respuesta perfectamente válida.',
        'cta'   => 'Leer el código',
    ],
];
