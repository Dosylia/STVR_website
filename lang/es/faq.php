<?php

return [

    'meta' => [
        'title'       => 'urSovngarde: preguntas',
        'description' => '¿Funciona con mi lista de mods? ¿Cuesta algo? ¿Me pueden banear? ¿Puedo jugar con alguien en Special Edition? Respuestas.',
    ],

    'hero' => [
        'kicker' => 'Las que salen cada semana',
        'title'  => 'Preguntas',
        'lede'   => 'Respuestas cortas. Y donde una respuesta corta sería mentira, una más larga.',
    ],

    'groups' => [

        [
            'title' => 'Lo básico',
            'items' => [
                [
                    'q' => '¿Qué es esto, en una frase?',
                    'a' => 'Un mod libre y gratuito que te deja jugar a Skyrim VR con amigos en un servidor que lleva uno de vosotros.',
                ],
                [
                    'q' => '¿Cuesta algo?',
                    'a' => 'No, y no puede costar nada. La licencia es GPLv3, heredada de Skyrim Together Reborn, lo que significa que el código sigue siendo público y cualquiera puede compilarlo. Necesitas tu propia copia de Skyrim VR; eso es todo.',
                ],
                [
                    'q' => '¿Es lo mismo que Skyrim Together Reborn?',
                    'a' => 'Es ese mod, portado. Reborn es para Skyrim Special Edition: otro ejecutable con otras direcciones de memoria y nada de VR. Cada hook del motor hubo que volver a encontrarlo para la build de VR, y todo lo que tiene que ver con manos y visores no existía siquiera. El multijugador que hay debajo es obra de Tilted Phoques y el mérito es suyo.',
                ],
                [
                    'q' => '¿Puedo jugar con alguien que tenga Special Edition?',
                    'a' => 'No. Otro ejecutable, otra build, otra disposición del mundo. Los dos necesitáis Skyrim VR.',
                ],
                [
                    'q' => '¿Cuánta gente puede jugar?',
                    'a' => 'Está construido y probado para grupos pequeños: de dos a cuatro amigos. No hay un límite técnico de sala, pero nadie lo ha llevado a una multitud, y la respuesta honesta es que una multitud encontraría las aristas más rápido de lo que te gustaría.',
                ],
            ],
        ],

        [
            'title' => 'Mods y compatibilidad',
            'items' => [
                [
                    'q' => '¿Funcionará con mi lista de mods?',
                    'a' => 'Probablemente, y ese es justo el objetivo: se carga junto a lo que ya juegas, por MO2, Vortex o una lista de Wabbajack. El único requisito duro es que <code>uGridsToLoad</code> se quede en 5.',
                ],
                [
                    'q' => '¿Necesitamos los dos los mismos mods?',
                    'a' => 'No byte a byte. La comprobación de mods está desactivada a propósito. Pero cuanto más parecidas sean las dos listas, menos sorpresas. Cualquier cosa que cambie qué existe en el mundo o qué es una criatura acabará produciendo «él ve un oso, yo veo un lobo».',
                ],
                [
                    'q' => '¿Necesito VRIK?',
                    'a' => 'Técnicamente no. En la práctica sí. VRIK es lo que te da un cuerpo, y tu cuerpo es lo que ve tu amigo. Sin él sigues ahí, solo que hay bastante menos de ti.',
                ],
                [
                    'q' => '¿Funciona con listas de Wabbajack como FUS?',
                    'a' => 'Sí. FUS es contra lo que se desarrolla a diario. Instala la carpeta del mod como cualquier otro mod y añade el lanzador como ejecutable.',
                ],
                [
                    'q' => '¿Funciona en Quest?',
                    'a' => 'Solo por PC VR: Virtual Desktop, Air Link, un cable. Esto es un mod de PC para el juego de PC; un visor autónomo no tiene ningún Skyrim VR que modear.',
                ],
            ],
        ],

        [
            'title' => 'Seguridad y sentido común',
            'items' => [
                [
                    'q' => '¿Me pueden banear por esto?',
                    'a' => 'No hay de dónde banearte. Skyrim VR no tiene anticheat ni componente en línea, y el juego nunca habla con un servidor nuestro. El lanzador de urSovngarde solo lo hace para buscar un código de invitación o, si aceptas, enviar un informe de fallo. Tus partidas son tuyas, en tu disco.',
                ],
                [
                    'q' => '¿Por qué el lanzador sustituye el ejecutable del juego?',
                    'a' => 'Porque así es como se entra en un juego cuyo código está cifrado en el disco. También es exactamente la forma de algo de lo que deberías desconfiar, así que: el código es público, la licencia lo mantiene público, y la release la construye un script de ese mismo repositorio. Compilarlo tú mismo es una respuesta perfectamente válida.',
                ],
                [
                    'q' => '¿Puede corromper mi partida?',
                    'a' => 'No lo ha hecho, y no está diseñado para escribir nada permanente en una. Haz copia de tus partidas igualmente. Estás ejecutando una alfa de un port a VR de un mod multijugador; una copia no te cuesta nada y la alternativa te cuesta una partida entera.',
                ],
                [
                    'q' => '¿Queda expuesta mi IP?',
                    'a' => 'Ante quien lleva el servidor y ante quienes estén en él, sí, igual que en cualquier juego donde aloja un amigo. Si eso te preocupa, usa una red virtual tipo Tailscale o ZeroTier en lugar de redirigir un puerto; así no queda nada accesible desde internet.',
                ],
            ],
        ],

        [
            'title' => 'Por dónde va',
            'items' => [
                [
                    'q' => '¿Está terminado?',
                    'a' => 'No. Es jugable, que es otra cosa y mucho más reciente. Se cuelga, los PNJ acaban a veces bajo el suelo, y los cuerpos no siempre coinciden entre visores. La hoja de ruta nombra las seis cosas que se están arreglando, en orden.',
                ],
                [
                    'q' => 'Se ha roto algo. ¿Qué necesitáis de mí?',
                    'a' => 'Tras un fallo, el lanzador pregunta si puede enviar un informe, quitando antes tus nombres y direcciones; es todo lo que necesitamos. Sin el lanzador, ejecuta <code>collect-logs.bat</code> en la carpeta del lanzador del mod y manda el zip que deja en tu Escritorio. Un volcado nombra la función exacta; una descripción nombra una sensación.',
                ],
                [
                    'q' => '¿Habrá página en Nexus?',
                    'a' => 'Sí, en cuanto la lista de cuelgues sea lo bastante corta como para que alguien que llega por primera vez pase una buena noche y no una noche interesante.',
                ],
                [
                    'q' => '¿Puedo ayudar?',
                    'a' => 'Sí. Jugar y reportar con precisión vale más de lo que parece: casi todo lo que se ha arreglado se encontró en el registro de alguien. Si haces ingeniería inversa, queda una lista corta de direcciones del motor sin mapear para VR, y el repositorio explica cómo se encontraron las demás.',
                ],
            ],
        ],
    ],

    'cta' => [
        'title'   => '¿No está respondido aquí?',
        'body'    => 'Abre una incidencia, o ven a preguntar.',
        'primary' => 'Preguntar en GitHub',
    ],
];
