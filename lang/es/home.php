<?php

return [

    'meta' => [
        'title'       => 'Skyrim VR multijugador: el mod cooperativo · urSovngarde',
        'description' => 'Juega a Skyrim VR en multijugador con amigos: un mod cooperativo libre y gratuito. Tu lista de mods, tu partida, tu servidor, y un amigo a tu lado, con sus manos reales.',
    ],

    'hero' => [
        'kicker'   => 'Skyrim VR multijugador · mod cooperativo · código abierto',
        'title'    => 'Ya no eres el único Sangre de Dragón',
        'lede'     => 'Cooperativo multijugador para Skyrim VR. Tu lista de mods, tu partida, tu servidor, y alguien que está de verdad en la habitación contigo, a su propia altura, con sus propias manos.',
        'primary'  => 'Descargar el lanzador',
        'secondary'=> 'Cómo instalarlo',
        'scroll'   => 'Seguir',
        'caption'  => 'Dos en la cresta. Uno de ellos no es un PNJ.',
    ],

    'stats' => [
        'version_label'  => 'Build actual',
        'version_none'   => 'Empaquetándose',
        'version_rolling'=> 'Última build',
        'launcher_label' => 'Lanzador',
        'launcher_note'  => 'Actualizado el :date',
        'port_label'     => 'Tu servidor, tu puerto',
        'port_note'      => 'UDP, redirigido o por VPN',
        'game_label'     => 'Funciona en',
        'game_value'     => 'Skyrim VR :version',
        'game_note'      => 'SKSE VR y la VR Address Library',
        'price_label'    => 'Precio',
        'price_value'    => 'Gratis, siempre',
        'price_note'     => 'GPLv3, código a la vista',
    ],

    'plain' => [
        'label' => 'Sin rodeos',
        'title' => 'Qué es esto en realidad',
        'body'  => 'Skyrim Together Reborn llevó el cooperativo a Skyrim Special Edition. Skyrim VR es otro ejecutable: otras direcciones de memoria, otras clases del motor, y un cuerpo donde antes solo había una cámara. Esto es ese mod, desmontado y vuelto a montar para la build de VR, por dos desarrolladores full-stack que aprendieron C++ e ingeniería inversa por el camino, lo cual tranquiliza o inquieta según el carácter.',
        'body2' => 'Es gratis, el código es público y nadie se registra en nada. Alojas tú, o aloja tu amigo. Nuestros propios servidores solo hacen las tareas pequeñas: encontrar a un amigo con un código de seis letras, llevar la partida por el relay cuando un router no abre un puerto, decirle al lanzador si hay una actualización, y recibir los informes de fallos que aceptas enviar. Las descargas y las comprobaciones de actualización se cuentan, y el recuento no dice nada de quién las hizo.',
    ],

    'features' => [
        'label'  => 'Lo que hace',
        'title'  => 'Todo esto está en la build que puedes descargar',
        'lede'   => 'Nada de lo que sigue es una promesa: está en la build de hoy. Lo que todavía falta aparece con nombre y apellidos en la hoja de ruta.',

        'items' => [
            [
                'rune'  => 'ᛗ',
                'title' => 'Está ahí de verdad',
                'body'  => 'La cabeza, las manos y la cadera cruzan la red. Con VRIK, tu amigo tiene cuerpo, así que cuando se asoma por una esquina, lo ves asomarse. Cuando señala, puedes seguir el brazo. No un casco flotante. Una persona.',
            ],
            [
                'rune'  => 'ᛟ',
                'title' => 'Un menú que pertenece a la VR',
                'body'  => 'El mod ocupa su propia pestaña en el panel de SteamVR: puntero láser, teclado de SteamVR, legible a una distancia cómoda. F6 conecta y desconecta sin quitarte el visor.',
            ],
            [
                'rune'  => 'ᚦ',
                'title' => 'Tus mods, intactos',
                'body'  => 'Mod Organizer 2, Vortex, una lista de Wabbajack como FUS, o ningún gestor. Tu orden de carga sigue siendo tuyo. El lanzador arranca el juego y carga SKSE por ti. No vuelves a tocar el loader de SKSE.',
            ],
            [
                'rune'  => 'ᛒ',
                'title' => 'Un mundo, no dos',
                'body'  => 'Misiones, clima y hora se comparten a través del grupo, y el grupo se forma solo en cuanto os conectáis. Un objeto soltado cae al mismo suelo en los dos visores, y por el camino sigue a la mano que lo lanzó.',
            ],
            [
                'rune'  => 'ᚾ',
                'title' => 'Tu servidor, tus reglas',
                'body'  => 'Un ejecutable y un puerto UDP. Redirígelo, o mete a todo el mundo en Tailscale, ZeroTier o Radmin y olvídate del router. Contraseña, PvP, qué cuesta morir: lo decides tú. Sin lobby, sin emparejamiento, sin cuenta.',
            ],
            [
                'rune'  => 'ᛉ',
                'title' => 'Se reconecta solo',
                'body'  => 'Una conexión caída lo reintenta a los 5 segundos, luego a los 10, 20, 30 y 60, y te lo dice en pantalla. Una rechazada no lo reintenta y explica por qué (build distinta, contraseña incorrecta) en lugar de dejarte mirando una puerta de carga.',
            ],
        ],
    ],

    'honest' => [
        'label' => 'La otra mitad de la verdad',
        'title' => 'Y se va a romper',
        'body'  => 'Esto es un mod de un mod de un motor de juego, metido a empujones en un visor. Se cuelga. Los PNJ se cuelan por el suelo de vez en cuando. Un cuerpo arrastrado en un mundo a veces se queda quieto en el otro. Mantenemos una lista de fallos conocidos que es concreta en lugar de apologética, un diario que admite cuándo un diagnóstico fue erróneo, y un .bat que empaqueta tus registros y el volcado de fallo en un único zip que puedes enviarnos.',
        'cta_roadmap' => 'Ver qué está roto',
        'cta_devlog'  => 'Leer el diario',
    ],

    'tips' => [
        'label' => 'De la pantalla de carga',
        'items' => [
            'Las builds que hablan los mismos mensajes de red se conectan, tengan la versión que tengan. Si el servidor rechaza una, el aviso nombra las dos versiones, y saber quién va por detrás lleva diez segundos.',
            'uGridsToLoad debe valer 5. Es el valor por defecto de todas las listas de Wabbajack, y el servidor no acepta ningún otro.',
            'VRIK es lo que le da cuerpo a tu amigo. Sin él sigue estando ahí, pero hay bastante menos que ver.',
            'El anfitrión se conecta a su propio servidor en 127.0.0.1, la misma dirección que todos los demás, sin el viaje.',
            'Jugad los dos con la misma lista de mods. «Él ve un oso, yo veo un lobo» casi siempre son dos órdenes de carga distintos.',
        ],
    ],

    'steps' => [
        'label' => 'Entrar',
        'title' => 'De cero a estar jugando',
        'lede'  => 'Cuatro pasos, y el lanzador hace la mayoría.',
        'items' => [
            ['n' => '1', 'title' => 'Preparar Skyrim VR', 'body' => 'SKSE VR y la VR Address Library for SKSEVR, como cualquier mod de SKSE. Engine Fixes VR y VRIK si quieres que esto esté bien y no solo que funcione. El lanzador comprueba tu instalación contra las trampas que conocemos.'],
            ['n' => '2', 'title' => 'Abrir el lanzador', 'body' => 'Encuentra Skyrim VR en tus bibliotecas de Steam y el gestor de mods que usas: Mod Organizer 2 (FUS y otras listas), Vortex o ninguno.'],
            ['n' => '3', 'title' => 'Instalar', 'body' => 'Un clic coloca el mod, lo añade a tu perfil de Mod Organizer y nombra lo que en tu instalación lo impediría, con la solución.'],
            ['n' => '4', 'title' => 'Jugar juntos', 'body' => 'Jugar arranca el juego como lo arranca tu instalación. Aloja una partida y da a tus amigos un código de seis caracteres, o únete a la suya. Carga una partida y ya estáis en un grupo.'],
        ],
        'cta' => 'La guía completa',
    ],

    'devlog' => [
        'label' => 'Desde el banco de trabajo',
        'title' => 'Qué se rompió esta semana, y qué era en realidad',
        'cta'   => 'Todas las entradas',
        'empty' => 'Las primeras entradas se están escribiendo.',
    ],

    'cta' => [
        'title' => 'Skyrim es un país grande para cruzarlo solo',
        'body'  => 'Gratis, de código abierto, y funciona con la lista de mods que ya tienes.',
        'primary' => 'Descargar el lanzador',
        'secondary' => 'Leer la guía de instalación',
    ],
];
