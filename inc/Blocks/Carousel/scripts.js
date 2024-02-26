import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';

export default {
    init() {
        const blocks = document.querySelectorAll('.wp-block-carousel');

        blocks.forEach(block => {
            if (block.classList.contains('swiper')) {
                new Swiper(block.querySelector('.swiper-container'), {
                    modules: [Navigation],
                    noSwiping: (window.innerWidth > 1280),
                    noSwipingClass: 'swiper-slide',
                    speed: (window.innerWidth > 1280) ? 0 : 200,
                    loop: true,
                    navigation: {
                        nextEl: block.querySelector('.swiper-button-next'),
                        prevEl: block.querySelector('.swiper-button-prev'),
                    },
                });
            }
        });
    }
}