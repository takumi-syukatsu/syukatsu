tablero=[[0,0,0],
         [0,0,0],
         [0,0,0]]


def escribir_tablero(jugador, linea, columna):
    if tablero[int(linea)][int(columna)] == 0:
        tablero[int(linea)][int(columna)] = jugador
        print('   0  1  2')
            
        for count, row in enumerate(tablero):
            print(count, row)
    else:
        print('error: posicion ocupada')    
        anadir_numero(jugador) 
        
def anadir_numero(jugador):
    print('jugador '+str(jugador))   
    linea= input('ponga un numero linea(0-2): ')
    columna= input('ponga un numero columna(0-2): ')

    try:
        if (not 0 <= int(linea) <= 2) or (not 0 <= int(columna) <= 2):
            print('error: la posicion no es valida')
            anadir_numero(jugador)
        else:
            escribir_tablero(jugador, linea, columna)
    except ValueError:
        anadir_numero(jugador)

    
def jugar():
    jugador = 1
    Juego_terminado = False
    escribir_tablero(0, 0, 0)

    while Juego_terminado is False :
        anadir_numero(jugador)

        if jugador == 1:
            jugador = 2
        else:
            jugador = 1

        Juego_terminado=comprobar_victoria()

        if Juego_terminado == True :
            break       


def comprobar_victoria():
    listo=[]
    resulta=[]
    
    for x in tablero:
        for numero in x:
            listo.append(numero)    
        
    por_linea = [0, 3, 6]
    
    for l in por_linea:
        resulta_l = listo[l] * listo[l + 1] * listo[l + 2]
        resulta.append(resulta_l)
            
    por_columna=[0, 1, 2]
    
    for c in por_columna:
        resulta_c = listo[c] * listo[c + 3] * listo[c + 6]
        resulta.append(resulta_c)
        
    diagonal_1 = listo[0] * listo[4] * listo[8]
    diagonal_2 = listo[2] * listo[4] * listo[6]
    
    if diagonal_1 == 1 or diagonal_2 == 1 or 1 in resulta:
        print('!!!!! el jugador 1 es el ganador!!!!!')
    elif diagonal_1 ==8 or diagonal_2 ==8 or 8 in resulta:
        print('!!!!! el jugador 2 es el ganador!!!!!') 
    elif not 0 in listo:
        print('todas celulas esta ocupado, han estampado')

        while True:
            otra_vez = input('quieren jugar otra vez? (1: Si, 2: No) : ')
            if otra_vez == '1':
                for a in range(3):
                    for b in range(3):
                        tablero[a][b] = 0 
                jugar()
            elif otra_vez == '2':
                print('chao!')
                break
            else:
                print('ponga el 1 o el 2')  
    else:
        return False

jugar()





