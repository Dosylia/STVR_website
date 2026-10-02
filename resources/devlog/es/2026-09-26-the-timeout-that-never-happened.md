---
title: El timeout que nunca ocurrió
date: 2026-09-26
summary: Toda una noche de arreglos se apoyaba en una lectura de los registros que resultó estar equivocada. Los arreglos siguen en pie; la historia que había detrás, no.
tags: cuelgues, diagnóstico
---

La noche del 25 leímos el paquete de registros de un amigo y concluimos que su cliente se
había caído cinco veces en plena sesión, y que el revuelo de esas caídas era lo que rompía
el mundo a su alrededor. Escribimos arreglos contra eso. Los arreglos son buenos. La
lectura estaba mal.

Esto es lo que significan de verdad los códigos de razón, leídos en
`TiltedConnect/Client.cpp` en vez de supuestos:

- **`0 kTimeout`** solo se reporta cuando el estado anterior era `Connecting`. Es un intento
  de conexión que nunca llegó a completarse, no una conexión viva que se corta. Los dos
  suyos, a las 21:16:01 y 21:16:16, son intentos fallidos tras cargar una partida.
- **`4 kAborted`** viene de `Client::Close()`. Es *este* cliente cerrando la conexión él
  mismo. Los tres suyos fueron cierres locales deliberados.

Así que no hubo ningún timeout a mitad de sesión. No menos de los que creíamos: ninguno.

## Los cuarenta y cinco actores tampoco eran un fallo

La otra mitad de la teoría de aquella noche era un momento, a las 21:19:01, en que el
cliente devolvió 45 actores de golpe, lo cual parecía exactamente el tipo de avalancha
capaz de dejar un mundo hecho pedazos.

Sus cambios de celda en esos tres minutos van (5,7) → (6,7) → (7,7) → (8,6) → (9,6) →
(10,7) → (11,7). Eso son unas 25 000 unidades cruzando Solstheim en tres minutos. El juego
descargó las celdas que iba dejando atrás, y el cliente soltó lo que había en ellas.

Eso no es un fallo. Eso es la cosa funcionando.

También explica un informe que habíamos archivado aparte. **Lydia estaba cuatro celdas por
detrás** — en x≈29000 mientras él estaba en x≈47000 — y eso es todo el contenido de «Seen
no ve a Lydia en absoluto» de las 21:21. No había desaparecido. Estaba en Cuervo de Roca.

## Lo que queda

Tres cosas de aquella sesión siguen sin explicación real:

1. Un bandido lanzado al cielo a las 21:19.
2. Un cadáver en el sitio equivocado a las 21:20.
3. Una spriggan cuyos golpes no llegan nunca, a las 21:25.

Las tres ocurrieron mientras cruzaba celdas a toda velocidad. De ese hilo estamos tirando
ahora, en lugar de la teoría del timeout que nunca existió.

## La lección, que seguimos reaprendiendo

La línea de diagnóstico `Silence:` que añadimos el 25 se queda. Un cliente que deja de
hablar sigue mereciendo que nos enteremos, y no cuesta nada. Pero su justificación ha
pasado de «esto es el fallo» a «esto es interesante», y ese descenso merece quedar escrito.

Tres veces el 27 de septiembre se culpó a algo distinto de un cuelgue: a la caché del
contacto del arma, luego a una lectura fuera de límites, luego al hardware del amigo. Cada
vez deducido de un cuelgue ocurrido poco después de destruir un lote de copias. Las tres
eran plausibles. Ninguna se comprobó contra una dirección.

El momento sugiere. Las direcciones zanjan.
