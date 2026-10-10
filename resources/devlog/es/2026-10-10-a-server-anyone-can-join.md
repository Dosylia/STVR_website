---
title: Un servidor al que puede unirse cualquiera
date: 2026-10-10
summary: Un servidor público, una página que muestra quién está en él y dónde, y las tres veces que al mapa se le perdió alguien por el camino.
tags: red, web
---

Hasta ahora, todas las formas de jugar empiezan por conocer a alguien. Uno aloja y el otro recibe
un código. Así es como jugará siempre la mayoría, y está bien que sea la opción por defecto. Pero
deja fuera a quien tiene el mod instalado, una tarde libre y nadie con quien jugar.

Así que estamos construyendo un servidor público: uno que esté siempre en marcha y al que pueda
unirse cualquiera, y una página en esta web que muestre quién está en él ahora mismo y dónde se
encuentra cada uno. Todavía no está abierto. Esto es lo que ya existe, y lo que ha costado.

## Cómo se entera la página

El servidor le comunica su estado a nuestro hub: su nombre, su dirección, su build, cuántos
jugadores hay conectados y, de cada jugador, el nombre de su personaje y dónde se encuentra. Lo hace
cada 10 segundos mientras haya alguien conectado, cada minuto cuando no hay nadie, y una vez más,
marcado como desconectado, cuando se detiene como es debido.

Solo lo hace el servidor público. La opción está desactivada en todos los demás servidores,
incluido el de un amigo, y además necesita una clave que solo tienen la máquina del servidor
público y el hub.

El hub guarda el último estado y nada anterior. Si el servidor pasa tres minutos en silencio, el
hub lo da por desconectado y quita de él a los jugadores. No se guarda nada de quién jugó ni de
cuándo.

De un jugador se envía el nombre de su personaje, nunca un nombre de Steam, una cuenta ni una
dirección.

## Sin llamar al hub más de la cuenta

El hub funciona con un plan gratuito: 100 000 peticiones al día para todo lo que hace, informes de
fallos y códigos de invitación incluidos. Una página que se actualizara sola en el navegador de cada
visitante se las gastaría en una tarde: cien personas mirando, cada una con una petición cada pocos
segundos.

Así que los navegadores nunca preguntan al hub. Le preguntan a esta web, que guarda la última
respuesta durante 5 segundos y solo vuelve al hub cuando la petición de un visitante se encuentra
con una copia más antigua que eso. Da igual cuánta gente mire: el hub tiene noticias nuestras como
mucho una vez cada 5 segundos, y ninguna cuando no mira nadie.

## Al mapa se le perdió gente tres veces

La página dibuja a cada jugador como un punto en nuestro propio mapa de Skyrim. El punto se mueve
cuando el jugador se mueve, y gira para mostrar hacia dónde mira. Poner los puntos en su sitio
costó tres intentos.

**Primero, las ciudades.** En los datos del juego, Carrera Blanca, Soledad, Ventalia, Riften y
Markarth son cada una un mundo aparte, separado del resto de Skyrim. Un jugador que cruzaba la
puerta de Carrera Blanca desaparecía del mapa. Pero comparten las coordenadas de Skyrim, así que
ahora se dibujan en el mismo mapa.

**Luego, los DLC.** Un jugador que iba a Solstheim, o que cruzaba el portal hacia el Recordatorio
de las Almas, desaparecía de la misma forma. Son lugares de verdad, con su propio suelo y sus
propias coordenadas, así que cada uno recibió su propio mapa: Solstheim, nevada en el norte y
cubierta de ceniza en el sur, y el Recordatorio de las Almas, un vacío violeta con islas de tierra
gris. La página los muestra como pestañas, cada una con cuántos jugadores hay allí, y se abre en
la que tiene más gente.

**Después, la calibración.** Una posición del juego se convierte en un punto del dibujo a partir
de dos lugares cuya posición conocemos tanto en el juego como en el dibujo. Empezamos con
estimaciones para Carrera Blanca y Ventalia. Cuando el servidor empezó a enviar posiciones exactas
del Fuerte Guardia del Alba y del Castillo Volkihar, resultó que las estimaciones ponían el fuerte
a 80 píxeles de donde está dibujado, y el castillo directamente fuera del borde del mapa. Ahora el
mapa de Skyrim se coloca a partir de esos dos puntos exactos, uno en cada esquina. Los lugares que
quedan entre ellos están dibujados a ojo, y una lectura en el mercado de Carrera Blanca nos dirá
cuánto se desvían.

## Quedarse fuera

No todo el mundo quiere ver a su personaje en una página pública. Un jugador que elige ocultarse
queda fuera de la lista y fuera del mapa por completo, y solo se le cuenta: la página dice
«5 jugadores» y añade «y un jugador más que no aparece en la lista».

## Estado

Hecho: el estado del servidor, la parte del hub y la página con sus tres mapas, los puntos en
directo, la lista de jugadores y un botón que abre el lanzador para unirse.

Todavía no: el servidor en sí no está abierto. Antes de que lo esté, necesita su clave, el mapa de
Solstheim necesita una lectura en dos lugares y el del Recordatorio de las Almas en uno, y quedan
por escribir las normas. Los nombres de lugar de la lista llegarán con la próxima build del mod. La
opción de ocultarse y el botón para unirse con un clic llegarán con la release del lanzador que abra
el servidor.

Cuando abra, estará en el menú de esta web, y aquí.
