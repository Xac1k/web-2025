function uniqueElements(arr) { //сдать на следующей лабе
    let obj = {}
    for (let idx = 0; idx < arr.length; idx++) {
        if (typeof obj[arr[idx]] === "undefined") {
            obj[arr[idx]] = 0
        }
        for (let key in obj) {
            if (arr[idx] == key) {
                isFound = true
                obj[key] += 1
                break
            }
        }
    }
    console.log(obj)
}

uniqueElements(['привет', 'hello', 1, '1', 1, 1, '2', '3'])