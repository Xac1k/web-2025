function mapObject(arr, statement) { //сдать на следующей паре 10.6
    let res = {}
    let f = statement
    for (let i in arr) res[i] = f(arr[i])
    return res
}

const nums = { a: 1, b: 2, c: 3 };

console.log(mapObject(nums, x => x**8))