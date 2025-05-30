const users = [ //сдать на следующей паре 10.5
    { id: 1, name: "Alice" },
    { id: 2, name: "Bob" },
    { id: 3, name: "Charlie" }
];

let newArray = users.map(function (elem) {
    for (let idx in elem) {
        if (idx == 'name') {
            return elem[idx]
        }
    }
})

console.log(newArray)
