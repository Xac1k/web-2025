function uniqueElements(arr) { //сдано
    if (Array.isArray(arr) && arr.length != undefined)
    {    
        let obj = {}
        for (let idx = 0; idx < arr.length; idx++) {
            const elem = arr[idx];
            if (!obj[elem]) obj[elem] = 1
            else obj[elem] += 1
        }
        console.log(obj)
    }
}

uniqueElements(['привет', 'hello', 1, '1', 1, 1, '2', '3'])