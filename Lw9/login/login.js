

document.addEventListener('DOMContentLoaded', () => {
    const passImg = document.getElementById("eye");
    const pass = document.getElementById("password");
    const email = document.getElementById("login");
    const submit = document.getElementById("submit");
    const error = document.getElementById("error");

    let mode = 0;

    passImg.addEventListener('click', () => {
        console.log(passImg.src);
        if (mode == 0) {
            mode = 1;
            passImg.src = '../image/eye_on.png';
            pass.type = 'text';
        } else {
            mode = 0;
            passImg.src = '../image/eye_off.png';
            pass.type = 'password';
        }
    });

    submit.addEventListener('click', () => {
        if(email.value.length == 0 || pass.value.length == 0) {
            error.style.opacity = '1';
        }
    });

    email.addEventListener('input', () => {
        if(email.value.length != 0 && pass.value.length != 0) {
            error.style.opacity = '0';
        }
    });

    pass.addEventListener('input', () => {
        if(email.value.length != 0 && pass.value.length != 0) {
            error.style.opacity = '0';
        }
    });

});

