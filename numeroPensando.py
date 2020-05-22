import random

x = random.randrange(1, 26)
n = 10

print('En que numero estoy pensando entre 1 y 25?')

while 0 < n:
    print('Tienes', str(n), 'intentos', sep = ' ')

    y = input('')

    if y.isdigit():   
        if int(y) != x:
            n -= 1
            if int(y) > x:
                print('El numero que pensando es menor')
            elif int(y) < x:
                print('El numero que pensando es mayor')    
        elif int(y) < 1 or 25 < int(y):
            n -= 1
            print('pon un numero entre 1 y 25')
        else:
            print('encontraste el numero que estaba pensando')
            break
    else:
        n -= 1
        print('pon un numero entre 1 y 25')        
if n < 1:
    print('no pudiste encontrar el numero que sansaba',str(x),sep=' ')
    
