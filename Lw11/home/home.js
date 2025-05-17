const max_height = 36;

document.addEventListener('DOMContentLoaded', () => {
    const main_elt = document.getElementsByClassName("post-frame__text");

    for (let idx_main = 0; idx_main < main_elt.length; idx_main++) {
        const inner_elt = main_elt[idx_main].children;
        let text_elt = '';
        let more_elt = '';
        for (let idx_inner = 0; idx_inner < inner_elt.length; idx_inner++) {
            const className = inner_elt[idx_inner].className;

            if (className == "post-frame__inner-text") {
                text_elt = inner_elt[idx_inner]
            }
            if (className == "post-frame__more") {
                more_elt = inner_elt[idx_inner]
            }
        }
        let mode = 0;
        if (text_elt.scrollHeight <= max_height) {
            more_elt.style.visibility = 'hidden';
            main_elt[idx_main].style.marginBottom = '8px';
        } else {
            more_elt.addEventListener('click', () => {
                if (mode == 0) {
                    mode = 1;
                    showText(main_elt[idx_main], text_elt, more_elt)
                } else {
                    mode = 0
                    hideText(main_elt[idx_main], text_elt, more_elt)
                }
            })
        }
    }
});

function hideText(parent_elt, text_elt, more_elt) {
    parent_elt.style.height = 'none';
    parent_elt.style.maxHeight = "37px";
    text_elt.style.maxHeight = "37px";
    text_elt.style.webkitLineClamp = '2';
    more_elt.textContent = 'ещё';
}

function showText(parent_elt, text_elt, more_elt) {
    parent_elt.style.height = 'fit-content';
    parent_elt.style.maxHeight = "none";
    text_elt.style.maxHeight = "fit-content";
    text_elt.style.webkitLineClamp = 'none';
    more_elt.textContent = 'скрыть';
}