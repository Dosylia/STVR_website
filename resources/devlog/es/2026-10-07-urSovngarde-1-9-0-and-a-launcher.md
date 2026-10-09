---
title: 1.9.0, con su propio nombre, y un lanzador
date: 2026-10-07
summary: La primera release que se llama urSovngarde, y un lanzador para que nadie tenga que volver a editar connect.txt.
tags: versiones, lanzador
---

Ha salido la 1.9.0, y es la primera release con el nombre urSovngarde: una descarga completa, una
actualización, un servidor.

## Actualizar ya no tiene que ser una decisión de grupo

Hasta ahora, un cliente y un servidor solo se hablaban si sus números de versión coincidían
exactamente. Un arreglo de una línea obligaba a todo el grupo a actualizar esa misma noche, o nadie
podía jugar.

Ahora el servidor compara un «protocol id»: un resumen de las definiciones de los mensajes de red.
Las builds que intercambian los mismos mensajes se conectan entre sí, sea cual sea su número de
versión. Un arreglo pequeño ya no obliga a todo el mundo a actualizar esa noche. Una release que sí
cambia los mensajes lo dice, y entonces todo el mundo actualiza, servidor incluido.

## Qué trae

- **Una seguidora pertenece a la partida de su jugador.** El 3 de octubre, Lydia pasó de una
  partida a la otra 92 veces en 15 segundos, cada partida quitándosela a la otra. Ahora pertenece a
  la partida del jugador al que sigue.
- **Un cadáver yace en el mismo sitio en los dos mundos.** Antes, los dos cuerpos podían acabar a
  unas mil unidades de distancia, que es mucho camino para buscar algo que acabas de matar.
- **Arrastrar cuerpos,** visto por los dos jugadores.
- **Hojas que se encuentran,** sentidas y oídas por los dos, y la regla del defensor para decidir
  si un golpe se paró. Esa tiene su propia entrada.
- **Cuerpos en el sitio correcto,** manos incluidas, y se acabó el estiramiento.
- **Volcados de fallo pequeños.** Ante un cuelgue, se escribe primero un volcado pequeño (muy por
  debajo de 4 MB), lo bastante pequeño como para enviarlo con un informe.
- **Dragones.** Un dragón que vuela en una partida ya no pasa a manos de la otra partida hasta que
  aterriza. Ese está en la build, pero todavía no se ha visto en una sesión de verdad.

## Un lanzador

Instalar un mod multijugador en una lista de mods de VR ha sido, hasta ahora, una página de
instrucciones y un archivo de texto llamado connect.txt. El lanzador sustituye casi todo eso. En
Windows:

- encuentra Skyrim VR y tu gestor de mods (Mod Organizer 2, incluida una lista como FUS, Vortex, o
  ninguno);
- instala y actualiza el mod desde la release más reciente;
- comprueba tu instalación y, para cada problema, muestra el arreglo y un enlace de descarga;
- arranca el juego;
- aloja con un código de invitación de seis letras, y se une con uno;
- te enseña cuáles de tus amigos de Steam están alojando;
- pregunta antes de enviar un informe de fallo, cada vez, salvo que le digas otra cosa;
- se actualiza solo.

Se descarga desde este sitio. Es nuevo, y esa lista es todo lo que hace. Si dice que ha comprobado
algo, ha comprobado eso, y nada más.
