document.addEventListener('DOMContentLoaded', () => {
    const elem = document.getElementById('load-file');
    const picture = document.getElementById('loading-file');
    const submite = document.getElementById('submite');
    const load_button = document.getElementById('load_button');
    const load_img = document.getElementById('load_img');

    picture.addEventListener('change', function () {

        const files = elem.files
        const file = files[0]
        load_button.style.visibility = 'hidden';
        load_img.style.visibility = 'hidden';

        const imageURL = URL.createObjectURL(file);
        picture.style.backgroundColor = '#FFFFFF';
        picture.style.backgroundImage = "url('" + imageURL + "')";
        picture.style.boxShadow = '';
        console.log(imageURL);

        submite.style.backgroundColor = '#222222';
    });

    submite.addEventListener('click', function () {
        if (elem.files[0] == undefined) { 
            picture.style.boxShadow = '0px 0px 4px 0px red inset';
        }
    });
});
