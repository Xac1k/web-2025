function isPrimeNumber(n) { //сдано
    if (Array.isArray(n)) {
        if (n.length != undefined)
        {
            for (let i = 0; i < n.length; i++) {
                if (Number.isInteger(n[i])) 
                {
                    printMSG(isPrimeOneNum(n[i]), n[i])
                }
                else 
                {
                    console.log(`Ошибка типа данных. '${n[i]}' не является числом`)
                }
            }
        }
        else 
        {
            console.log('Ошибка типа данных. Обнаружен Object')
        }
    }
    else
    {
        if (Number.isInteger(n)) 
        {
            printMSG(isPrimeOneNum(n), n)
        }
        else 
        {
            console.log(`Ошибка типа данных. ${n} не является число или массивом числе`)
        }
    }
    
}

function isPrimeOneNum(n) {
    let isPrime = true
    for (let j = 2; j < n; j++) {
        if (n % j == 0) {
            isPrime = false
            break
        }
    }
    return isPrime
}

function printMSG(isPrime, n) {
    if (isPrime == true) {
        console.log(`${n} простое число`)
    }
    else {
        console.log(`${n} не простое число`)
    }
}

isPrimeNumber(true)
