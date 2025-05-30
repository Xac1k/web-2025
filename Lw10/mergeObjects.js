function mergeObjects(obj1, obj2) { //сдать на следующей паре 10.4
    resObj = {}
    for (let key in obj1) {
        if (obj2[key] != undefined) 
        {    
            resObj[key] = obj2[key]
        }    
        else 
        {
        resObj[key] = obj1[key]
        }
    }
    for (let key in obj2) {
        if (resObj[key] == undefined) 
        {    
            resObj[key] = obj2[key]
        }
    }
    console.log('Конечный объект', resObj)
}

mergeObjects({ a: 1, b: 2 }, { b: 3, c: 4, ghgh: '1133423'})