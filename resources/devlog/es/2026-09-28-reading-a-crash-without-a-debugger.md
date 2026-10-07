---
title: Leer un cuelgue sin depurador
date: 2026-09-28
summary: El lanzador sustituye el ejecutable del juego, así que un volcado muestra un único módulo de 90 MB con el código del juego y el nuestro dentro. Así los separamos.
tags: cuelgues, herramientas
---

Cuando urSovngarde se cuelga, el volcado es inútil de una forma muy concreta:
muestra **un** módulo, de unos 90 MB, llamado `SkyrimTogetherVR.exe`. El código del juego y
el nuestro están los dos dentro. Los nombres de módulo no pueden separarlos, porque para
Windows solo hay uno.

El 27 de septiembre dedicamos varias horas a intentar que `dbghelp` cargara el PDB de esa
imagen. No lo hará. `SymLoadModuleEx` informa del módulo como diferido y después declara no
encontrada cada función conocida. No merece la pena volver a intentarlo, y esta entrada
existe en parte para que la siguiente persona, probablemente uno de nosotros, dentro de dos
meses, no lo haga.

## Lo que sí funciona: el mapa del enlazador

`Code/immersive_launcher/xmake.lua` pasa `/MAP`, que produce
`build/windows/x64/release/SkyrimTogetherVR.map`. El mapa lista **solo nuestros símbolos**.
Así que una dirección que él nombre es nuestra, y toda la imagen del juego cabe en un único
símbolo llamado `?game_seg@@3PAEA`.

Ese único hecho es la base entera de las herramientas de cuelgue. De ahí salieron tres, de
la más barata a la más laboriosa:

**`explain-crash.py`** lee el volcado de registros que el cliente escribe en `tp_client.log`
y nombra las funciones. No hace falta archivo de volcado, solo el registro y el exe y el PDB
que le corresponden.

**`explain-dump.py`** lee un `.dmp` de verdad. Imprime la excepción, los registros, en qué
función estaba `Rip`, y después el anillo `RecentDeletes`: las últimas 32 copias remotas que
este cliente borró, qué seguía reclamando cada una, y si algún registro contiene ahora mismo
alguna de ellas.

Una línea `MATCH` significa que el código que falló estaba sosteniendo un actor que habíamos
borrado, y que la ruta de destrucción es la causa. `NO MATCH` significa que no, y la
búsqueda se mueve a otra parte. Esa única distinción es el propósito de toda la herramienta.

**`minidump.py`** es la capa de debajo, para cuando la pregunta es simplemente «¿hay algo
aquí dentro que sea nuestro?».

## La trampa que hay en medio

El mapa tiene que venir de la build que se colgó.

Un mapa caducado no falla. Nombra las funciones equivocadas, lee las direcciones
equivocadas, y parece completamente plausible mientras lo hace. Pasa un mapa actual contra
un volcado del 13 de septiembre y anunciará con aplomo «0 borrados de actores registrados en
esta sesión», para una build escrita dos semanas antes de que `RecentDeletes` existiera.

`explain-dump.py` ahora compara la marca de tiempo del mapa con la del módulo del volcado y
se niega en vez de adivinar. Si usas `minidump.py` o `mapsym.py` directamente, esa
comprobación corre de tu cuenta.

## Y una cosa que sencillamente no se puede

El ejecutable del juego en disco está cifrado por Steam. Una dirección dentro de
`?game_seg@@3PAEA` no se puede desensamblar sin ejecutarlo. Nombrar a un llamante
desconocido del lado del juego exige o un hook dentro del juego o la base de datos de
direcciones: no hay una tercera opción, y una tarde buscándola es una tarde.
