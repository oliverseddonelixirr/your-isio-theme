import { throttle } from '@js/utils';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';

const options = {
    item: 'wp-block-cards',
    jump: 'wp-block-jump-content',
    jsWrapper: 'js-swiper-wrapper',
    mobile: 'swiper-mobile',
    desktop: 'swiper-desktop',
    swiper: 'swiper',
    wrapper: 'swiper-wrapper',
    container: 'swiper-container',
    controls: 'swiper-controls',
    next: 'swiper-button-next',
    prev: 'swiper-button-prev',
};

let swiper = undefined;

export default {
    init() {
        const blocks = document.querySelectorAll(`.${options.item}`);

        if (blocks.length > 0) {
            blocks.forEach((block) => {
                if (block.classList.contains(options.swiper)) {
                    toggleSwiper(block);

                    window.addEventListener(
                        'resize',
                        throttle(() => {
                            toggleSwiper(block);
                        }, 100),
                        false
                    );
                }
            });
        }
    },
};

const makeSwiper = (block) => {
    const columns = block.dataset.columns;
    let spaceBetween = columns < 3 ? 40 : 40;

    if (document.querySelector(`.${options.jump}`) && columns < 3) {
        spaceBetween = 40;
    }

    swiper = new Swiper(block.querySelector(`.${options.container}`), {
        modules: [Navigation, Pagination],
        loop: false,
        slidesPerView: 1.1,
        spaceBetween: 20,
        autoHeight: false,
        navigation: {
            nextEl: block.querySelector(`.${options.next}`),
            prevEl: block.querySelector(`.${options.prev}`),
        },
        onAny(eventName, ...args) {
            if (eventName === 'click') {
                const slides = args[0].slides;
                slides.forEach((slide) => {
                    if (slide.classList.contains('swiper-slide-active')) {
                        const link = slide.querySelector('a');
                        link.click();
                    }
                });
            }
        },
        pagination: {
            el: '.js-swiper-pagination',
            clickable: true,
            renderBullet: (index, className) => {
                return `<button type="button" class="${className} wp-block-cards__pagination__bullet">&bull;</button>`;
            },
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: `${columns}.1`,
                spaceBetween,
            },
        },
    });
};

const destroySwiper = (element, swiper) => {
    swiper.destroy();

    const wrapper = element.querySelector(`.${options.jsWrapper}`);
    wrapper.classList.remove(options.wrapper);

    const controls = element.querySelector(`.${options.controls}`);
    controls.style.display = 'none';
};

const createSwiper = (element) => {
    const wrapper = element.querySelector(`.${options.jsWrapper}`);
    wrapper.classList.add(options.wrapper);

    const controls = element.querySelector(`.${options.controls}`);
    controls.style.display = 'flex';
};

const toggleSwiper = (block) => {
    const breakpoint = 1024;

    if (
        (block.classList.contains(options.mobile) &&
            window.innerWidth > breakpoint) ||
        (block.classList.contains(options.desktop) &&
            window.innerWidth < breakpoint)
    ) {
        if (swiper !== undefined && !swiper?.destroyed) {
            destroySwiper(block, swiper);
        }
    } else {
        createSwiper(block);
        if (swiper === undefined || swiper?.destroyed) {
            makeSwiper(block);
        }
        swiper.init();
    }
};
