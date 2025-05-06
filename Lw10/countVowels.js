function countVowels(str) { //сдано
    let cnt = 0;
    let res = '';
    for (let i = 0; i < str.length; i++) {
        if (['а', 'е', 'ё', 'и', 'о', 'у', 'ы', 'э', 'ю', 'я'].includes(str[i])) {
            cnt++;
            res += (cnt == 1) ? `${str[i]}` : `, ${str[i]}` 
        }
    }
    console.log(`${cnt}  (${res})`)
}

countVowels("Привет, мир!")