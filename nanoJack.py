import random

mazo = []

def generar_mazos(cantidadMazos):
    for x in range(0, 4 * cantidadMazos):
        for y in range(1, 14):
            mazo.append(y)
    random.shuffle(mazo)
    return mazo

#mazo = generar_mazos(1)

def jugar(mazo):
    cuenta = 0
    while cuenta < 21:
        if len(mazo) == 0:
            return 0
        cuenta += mazo.pop(0)
    return cuenta

# print(jugar(generar_mazos(1)))  // devuelve un numero = o > a 21

def jugar_varios(mazo, cantJugadores):
    resultados = []
    for x in range(cantJugadores):
        resultados.append(jugar(mazo))
    return resultados

# print(jugar_varios(generar_mazos(1), 4)) // devuelve una lista con cuatro resultados [21, 25, 27, 21] ej

def ver_quien_gano(resultado):
    ganadores = []
    for x in range(0, len(resultado)):
        if resultado[x] == 21:
            ganadores.append(1)
        else:
            ganadores.append(0)
    return ganadores

# print(ver_quien_gano(jugar_varios(generar_mazos(1), 4))) // devuelve una lista con 0s o 1s [0, 1, 0, 1] 

def experimentar(rep, n):
    listaValores = []
    for y in range(n):
        listaValores.append(0)
    for x in range(rep):
        listaTemp = ver_quien_gano(jugar_varios(generar_mazos(n), n))
        listaValores = [x + y for x, y in zip(listaValores, listaTemp)]
    return listaValores

print(experimentar(10, 5))



