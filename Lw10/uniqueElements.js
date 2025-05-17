function uniqueElements(arr) { //сдать на следующей лабе 10.3
    let obj = {}
    for (let idx = 0; idx < arr.length; idx++) {
        const elem = arr[idx];
        if (!obj[elem]) obj[elem] = 0
        for (let key in obj) if (elem == key) obj[key] += 1
    }
    console.log(obj)
}

uniqueElements(['привет', 'hello', 1, '1', 1, 1, '2', '3'])