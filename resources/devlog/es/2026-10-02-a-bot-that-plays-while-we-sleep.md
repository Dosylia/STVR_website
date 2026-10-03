---
title: Un bot que juega mientras dormimos
date: 2026-10-02
summary: Encontrar una regresión un viernes por la noche, con un amigo dentro del visor, es la forma más cara de encontrar una regresión.
tags: pruebas, herramientas
---

Durante la mayor parte de este proyecto, la batería de pruebas fueron dos personas con
visores un viernes por la noche.

Eso tiene ventajas reales: encuentra lo que importa, porque los únicos fallos que se
reportan son los que arruinaron algo. También tiene un problema evidente: el ciclo de
realimentación dura una semana, cuesta a dos personas una tarde, y más o menos la mitad de
la información llega como «se puso raro cerca del campamento de bandidos».

Así que ahora hay un bot. Levanta el cliente sin pantalla, se conecta a un servidor y juega
una serie de parejas guionizadas: dos clientes, un escenario cada uno, un estado final
esperado conocido.

## Qué captura de verdad

Jugabilidad no. El bot no tiene opinión sobre si el combate se siente bien. Lo que captura
es la categoría de fallo que se ha comido casi todo este mes: un cuelgue al destruir, un
actor entregado a código que todavía lo sostiene, una extensión nula en un hook que antes
era seguro.

Son exactamente los fallos invisibles hasta que son catastróficos, los que dependen del
momento exacto, y los que un probador humano reproduce una vez de cada cinco. Una máquina
corriendo el mismo escenario cuarenta veces de madrugada los reproduce con fiabilidad
suficiente para ponerles una dirección encima, y una dirección, como no dejamos de
escribir, es lo único que zanja un cuelgue.

## La parte que no era obvia

La primera versión del bot se probaba a sí misma.

No a propósito: el arnés conducía los dos clientes desde un solo proceso y compartía estado
entre ellos, así que un escenario superado solo demostraba que el arnés era coherente
consigo mismo. Dos clientes que coinciden porque son el mismo objeto no son dos clientes.

Separarlos fue la mayor parte del trabajo, y por eso el commit que los añade dice *«el bot
deja de probarse a sí mismo»* en lugar de algo más halagador.

## Cuatro escenarios nuevos esta semana

Salieron del trabajo con los objetos soltados: un objeto lanzado y atrapado, un objeto
soltado mientras quien lo lanza cruza un límite de celda, dos jugadores agarrando el mismo
objeto, y un objeto soltado sobre geometría que solo uno de los dos clientes tiene cargada.
El último está ahí porque es la forma del fallo que esperamos encontrar a continuación, y
una prueba escrita antes del fallo es la única que puede demostrar que ya no está.
