function mapObject(arr, statement) { //сдать на следующей паре
    let res = {}
    let f = statement
    for (let i in arr){
        res[i] = f(arr[i])
    }
    console.log(res)
}

const nums = { a: 1, b: 2, c: 3 };

mapObject(nums, x => x**8)