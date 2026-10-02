---
title: La cadera cruza la red
date: 2026-09-30
summary: VRIK te da un cuerpo. Hasta esta semana tu amigo no veía moverse casi nada de él. Tres articulaciones después, sí.
tags: vr, sincronización
---

Skyrim Together Reborn se escribió para un juego en el que el jugador es una cámara con un
arma pegada. Todo lo que hace un jugador remoto se puede reconstruir a partir de una
posición, una orientación y un nombre de animación, porque en el Skyrim plano eso es
realmente todo lo que hay.

La VR no es eso. En VR el jugador es una cabeza y dos manos moviéndose por separado dentro
de una habitación, y VRIK construye un cuerpo verosímil alrededor. Manda solo posición y
orientación y tu amigo obtiene un maniquí que se desliza por el suelo mirando al frente
mientras su dueño está en realidad agachado tras una roca, mirando hacia arriba, con un
brazo estirado.

## Tres articulaciones, no treinta

La tentación es mandar el esqueleto entero. No lo vamos a hacer, y no solo por el ancho de
banda. Un esqueleto completo significa que el otro extremo tiene que estar de acuerdo sobre
el nombrado de huesos, la escala del rig y los ajustes del propio solver de VRIK —y la causa
número uno de «él ve un oso, yo veo un lobo» ya son dos listas de mods que no se ponen de
acuerdo. Añadir un contrato de treinta huesos entre ellas sería invitar a esa misma clase de
fallo precisamente al único sistema que tiene que ser fiable.

Así que: cabeza, manos, cadera. VRIK ya sabe construir un cuerpo a partir de una cabeza y
dos manos —es literalmente su trabajo— y la cadera es lo que no puede deducir. Dónde está tu
cadera decide si estás de pie, agachado, inclinado, o girado por la cintura mientras miras
hacia otro lado.

Con la cadera cruzando la red, tres cosas empezaron a funcionar a la vez que habíamos estado
tratando como problemas distintos:

- Asomarse por una esquina **parece** asomarse por una esquina.
- Agacharse se lee como agacharse y no como una persona más baja.
- Girarse para mirar atrás ya no rota el cuerpo entero con la cabeza, que era lo más
  inquietante que había en el juego y a lo que llamábamos «el búho».

## Lo que costó

Uno de los commits de este trabajo se llama *La cadera alcanza el cuerpo*, lo que debería
decirte cómo fue el primer intento. La posición de la cadera llegaba en el espacio
equivocado —números correctos, origen equivocado— así que los jugadores remotos se quedaban
con la pelvis como un metro por delante del pecho. Parecía menos un fallo que una maldición.

## Sigue abierto

Los gestos van después, y son otro problema. Alcanzar por encima del hombro, enfundar en la
cadera, coger algo del aire: eso son *interacciones* de VRIK, y ahora mismo tu amigo ve la
animación estándar más parecida en lugar de lo que tú hiciste. Es el objetivo tres de la
hoja de ruta, y es el que decidirá si esto se siente como multijugador en VR o como Skyrim
multijugador con un visor puesto.
