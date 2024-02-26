import { throttle, getNextSibling } from '@js/utils';

const options = {
    item: 'js-faq-archive',
    wrapper: 'js-faq-list-section',
    accordion: 'js-faq-list-accordion',
    list: 'js-faq-list',
};

export default {
    init() {
        const accordion_archive = document.querySelectorAll(`.${options.item}`);
        const accordions = document.querySelectorAll(`.${options.accordion}`);

        if (accordion_archive.length > 0) {
            if (accordions.length > 0) {
                Array.prototype.forEach.call(accordions, (accordion) => {
                    const section = accordion.closest(`.${options.wrapper}`);
                    const list = section.querySelector(`.${options.list}`);

                    // Add first tab in list a active
                    initAccordions(list);

                    // Listen for resize and reset attributes as required
                    window.addEventListener(
                        'resize',
                        throttle(() => {
                            initAccordions(list);
                        }, 100),
                        false
                    );

                    // Setup mobile click event
                    section.addEventListener('click', (e) => {
                        if (e.target.classList.contains(options.accordion)) {
                            const list = getNextSibling(
                                e.target,
                                `.${options.list}`
                            );

                            if (list.getAttribute('hidden')) {
                                showPanels(list, e.target);
                            } else {
                                hidePanels(list, e.target);
                            }
                        }
                    });
                });
            }
        }
    },
};

const initAccordions = (list) => {
    const breakpoint = 1024;

    if (window.innerWidth < breakpoint) {
        hidePanels(list);
    } else {
        showPanels(list);
    }
};

const hidePanels = (list, button) => {
    if (button) {
        button.setAttribute('aria-selected', false);
    }
    list.setAttribute('hidden', true);
};

const showPanels = (list, button) => {
    if (button) {
        button.setAttribute('aria-selected', true);
    }
    list.removeAttribute('hidden');
};
