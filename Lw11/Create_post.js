const elem = document.getElementById('load-file');
const picture = document.getElementById('loading-file');
const submite = document.getElementById('submite');
const text = document.getElementById('text-field');
const loadButton = document.getElementById('loadButton');
const load_img = document.getElementById('load_img');

window.onload = () => {
    picture.addEventListener('change', function () {
        const files = elem.files
        const file = files[0]
        loadButton.style.visibility = 'hidden';
        load_img.style.visibility = 'hidden';

        const imageURL = URL.createObjectURL(file);
        picture.style.backgroundColor = '#FFFFFF';
        picture.style.backgroundImage = "url('" + imageURL + "')";
        picture.style.boxShadow = '';
        console.log(imageURL);

        if (text.value.length != 0) {
            submite.style.backgroundColor = '#222222';
        }
    });

    text.addEventListener('input', function () {
        if (elem.files[0] !== undefined) {
            submite.style.backgroundColor = '#222222';
        }
        if (text.value.length == 0) {
            submite.style.backgroundColor = '';
        }
    });

    submite.addEventListener('click', function () {
        if (elem.files[0] === undefined) {
            picture.style.boxShadow = '0px 0px 4px 0px red inset';
        }
    });
}
