const lowChar = 'abcdefghijklmnopqrstuvwxyz' //Сдать на следующей паре
const upChar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
const numbers = '0123456789'
const specials = '!@#$%^&*()_+-=[]{}|:,.<>?'

function generatePassword(length)
{
    if(Number.isInteger(length) && (length => 4))
    {
        const password = []
        password.push(numbers[Math.ceil(Math.random() * numbers.length)])
        password.push(upChar[Math.ceil(Math.random() * upChar.length)])
        password.push(lowChar[Math.ceil(Math.random() * lowChar.length)])
        password.push(specials[Math.ceil(Math.random() * specials.length)])


        const allChar = lowChar + upChar + numbers + specials
        for(let i = 4; i < length; i++)
        {
            password.push(allChar[Math.ceil(Math.random() * allChar.length)])
        }
        
        password.sort((x, y) => Math.random() * 100)
        console.log(password.join(''))
    }
    else
    {
        if (!Number.isInteger(length))
        {
            console.log('Ошибка типов данных')
        }
        {
            console.log('Пароль должен быть длины от 4 символов')
        }
    }
}

generatePassword(27)