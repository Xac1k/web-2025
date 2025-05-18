const max_height = 36;
const textClass = "post-frame__inner-text_hidden";
const moreClass = "post-frame__more";

const sliderLClass = "post-frame__slider_left";
const sliderRClass = "post-frame__slider_right";
const imageClass = "post-frame__images";
const imageClassHide = "post-frame__images_hidden";
const counterClass = "post-frame__counter-foto";

const containerImageClass = "image-frame_inner";
const postFrameClass = "post-frame__post";

function findTextMore(parent_elt) {
    let text_elt = '';
    let more_elt = '';
    for (let idx_inner = 0; idx_inner < parent_elt.length; idx_inner++) {
        const className = parent_elt[idx_inner].className;
        //console.log(className)

        if (className == textClass) {
            text_elt = parent_elt[idx_inner]
        }
        if (className == moreClass) {
            more_elt = parent_elt[idx_inner]
        }
    }
    return [text_elt, more_elt]
}

function hideMore(main_elt, more_elt) {
    more_elt.style.visibility = 'hidden';
    main_elt.style.marginBottom = '8px';
}

function hideText(parent_elt, text_elt, more_elt) {
    parent_elt.className = 'post-frame__text_wraped-more';
    text_elt.className = 'post-frame__inner-text_hidden';
    more_elt.textContent = 'ещё';
}

function showText(parent_elt, text_elt, more_elt) {
    parent_elt.className = 'post-frame__text_nowraped-more';
    text_elt.className = 'post-frame__inner-text_show';
    more_elt.textContent = 'свернуть';
}

function addEventsMore(main_elt) {
    for (let idx_main = 0; idx_main < main_elt.length; idx_main++) {
        const one_elt = main_elt[idx_main]
        const inner_elts = one_elt.children;
        const [text_elt, more_elt] = findTextMore(inner_elts);

        let mode = 0;
        if (text_elt.scrollHeight <= max_height) {
            hideMore(one_elt, more_elt)
        } else {
            more_elt.addEventListener("click", () => {
                if (mode == 0) {
                    mode = 1;
                    showText(one_elt, text_elt, more_elt)
                } else {
                    mode = 0
                    hideText(one_elt, text_elt, more_elt)
                }
            })
        }
    }
}

function addEventsSlider(slider_elts) {
    for (let main_idx = 0; main_idx < slider_elts.length; main_idx++) {
        const sliderL_elt = slider_elts[main_idx];
        const parent_elt = sliderL_elt.parentElement;
        const sliderR_elt = parent_elt.getElementsByClassName(sliderRClass)[0];
        const image_elts = parent_elt.getElementsByClassName(imageClass);

        const counter_elt = parent_elt.getElementsByClassName(counterClass)[0];

        let counter = 0;

        sliderL_elt.addEventListener("click", () => {
            image_elts[counter].classList.add(imageClassHide);
            counter = counter == 0 ? image_elts.length - 1 : counter - 1;
            counter_elt.textContent = counter + 1 + '/' + image_elts.length;
            image_elts[counter].classList.remove(imageClassHide);
        })

        sliderR_elt.addEventListener("click", () => {
            image_elts[counter].classList.add(imageClassHide);
            counter = counter == image_elts.length - 1 ? 0 : counter + 1;
            counter_elt.textContent = counter + 1 + '/' + image_elts.length;
            image_elts[counter].classList.remove(imageClassHide);
        })
    }
}

function addEventEsc(esc_elt, modal_elt) {
    esc_elt.addEventListener("click", () => {
                    modal_elt.innerHTML = '';
                    modal_elt.className = 'modal-frame_hidden';
                    esc_elt.removeEventListener("click", () => {
                        modal_elt.innerHTML = '';
                        modal_elt.className = 'modal-frame_hidden';
                    });
                })
}

function addEventModal(containers_img, modal_elt) {
    for (let main_idx = 0; main_idx < containers_img.length; main_idx++) {
        const parent_elt = containers_img[main_idx].parentElement;
        containers_img[main_idx].addEventListener("click", () => {
            modal_elt.className = 'modal-frame_active';
            modal_elt.innerHTML = parent_elt.outerHTML;
            const modal_img_frame= modal_elt.getElementsByClassName(containerImageClass)[0];
            const esc = document.createElement("img");
            esc.src = "../image/esc.png";
            esc.className = "modal-frame_esc";
            modal_img_frame.appendChild(esc);

            const modal_post_frame = modal_elt.getElementsByClassName(postFrameClass)[0];
            const modal_images = modal_elt.getElementsByClassName(imageClass);
            const sliderR_modal_elt = modal_elt.getElementsByClassName(sliderRClass)[0];
            const sliderL_modal_elt = modal_elt.getElementsByClassName(sliderLClass)[0];
            const counter_elt_modal = modal_elt.getElementsByClassName(counterClass)[0];

            for (let idx = 0; idx < modal_images.length; idx++) {
                modal_images[idx].classList.add('modal-frame_image');
            }

            modal_img_frame.className = 'modal-frame_image-container';
            modal_post_frame.className = 'modal-frame_image-container';

            addEventEsc(esc, modal_elt);

            document.addEventListener("keyup", (e) => {
                if (e.key == 'Escape' && !e.repeat) {
                    modal_elt.innerHTML = '';
                    modal_elt.className = 'modal-frame_hidden';
                }
            });

            if(sliderR_modal_elt && sliderL_modal_elt && counter_elt_modal) {
                let counter = 0;
                hideImage(modal_images, counter)
                sliderR_modal_elt.classList.add('model-frame_sliderR');
                sliderL_modal_elt.classList.add('model-frame_sliderL');
                counter_elt_modal.textContent = counter + 1 + ' из ' + modal_images.length;
                counter_elt_modal.className = 'model-frame_counter';

                sliderL_modal_elt.addEventListener("click", () => {
                    modal_images[counter].classList.add(imageClassHide);
                    counter = counter == 0 ? modal_images.length - 1 : counter - 1;
                    counter_elt_modal.textContent = counter + 1 + ' из ' + modal_images.length;
                    modal_images[counter].classList.remove(imageClassHide);
                })

                sliderR_modal_elt.addEventListener("click", () => {
                    modal_images[counter].classList.add(imageClassHide);
                    counter = counter == modal_images.length - 1 ? 0 : counter + 1;
                    counter_elt_modal.textContent = counter + 1 + ' из ' + modal_images.length;
                    modal_images[counter].classList.remove(imageClassHide);
                })
            }
        })
    }
}

function hideImage(ImagesHTML, counter){
    for (let idx = 0; idx < ImagesHTML.length; idx++) {
        if (idx == counter) {
            ImagesHTML[idx].classList.remove('post-frame__images_hidden');
        } else {
            ImagesHTML[idx].classList.add('post-frame__images_hidden');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const main_elts_text = document.getElementsByClassName("post-frame__text_wraped-more");
    addEventsMore(main_elts_text);

    const slider_elts_image = document.getElementsByClassName(sliderLClass);
    addEventsSlider(slider_elts_image);

    const container_img = document.getElementsByClassName(containerImageClass);
    const model_elt = document.getElementsByClassName("modal-frame_hidden")[0];
    addEventModal(container_img, model_elt)
});