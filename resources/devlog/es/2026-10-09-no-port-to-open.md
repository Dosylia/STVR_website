---
title: Ningún puerto que abrir
date: 2026-10-09
summary: Alojar empezaba antes por la página de ajustes de tu router. Ahora el lanzador pasa por un pequeño relay nuestro.
tags: red, lanzador
---

El motivo más habitual por el que dos amigos no conseguían jugar juntos nunca fue el mod. Era el
router de quien alojaba.

Abrir un puerto UDP es fácil para algunas personas e imposible para otras. Algunos operadores
comparten una misma dirección pública entre muchos hogares, y entonces no hay ningún puerto que
abrir, por mucho tiempo que pases en la página de ajustes del router.

## Lo que miramos primero

Primero las opciones gratuitas, porque escribir un relay no es la parte divertida de un mod de VR.

playit.gg funcionaría, pero para un juego que no está en su lista hace falta el plan de pago.
Tailscale, ZeroTier y Radmin VPN funcionan todos, y la página del servidor lleva semanas
recomendándolos, pero cada uno pide a todos los jugadores que instalen y configuren algo antes de
poder unirse.

Así que escribimos nuestro propio relay: un pequeño programa en un servidor que alquilamos.

## Cómo funciona

Cuando alojas, el lanzador abre un único flujo UDP saliente hacia el relay y registra una sesión.
El tráfico saliente es lo que los routers domésticos ya permiten, así que no hay nada que abrir. Tu
código de invitación da nombre a esa sesión.

Un amigo que se une con el código obtiene un túnel en su lanzador. Ni el juego ni el servidor se
enteran de nada de esto: cada uno habla con un túnel en su propio PC, como si el otro extremo
estuviera a su lado.

El tráfico del juego va cifrado por la propia red del juego, así que el relay transmite bytes que
no puede leer.

Además está hecho para sobrevivir a un reinicio. Si el relay desaparece un momento, los túneles
notan el silencio y recuperan su sitio por sí solos.

## La velocidad

Medido desde el PC de Emma: una mediana de 50 ms para un viaje de ida y vuelta que cruzó el relay
dos veces. Son unos 25 ms en cada sentido desde su línea, y volvieron 50 paquetes de 50.

## Estado

En marcha desde el 9 de octubre, para el lanzador 0.3.0 y posteriores, en los dos lados. Es nuevo:
todavía no ha llevado una sesión de juego completa. Si un amigo no consigue conectarse, la
redirección de puertos y Tailscale siguen funcionando exactamente igual que antes.

## También en el lanzador esta semana

El lanzador 0.3.2 trae dos cosas más:

- Con Vortex 1.14 o posterior, el mod se instala como un mod de Vortex y aparece en su lista. Con
  un Vortex más antiguo, los archivos se copian en Data como antes.
- La espera después de pulsar Jugar es una pantalla de carga que sigue el arranque real, paso a
  paso. Si un servidor te rechaza, dice por qué; una versión equivocada muestra las dos versiones.
