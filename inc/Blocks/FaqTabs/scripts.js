import { throttle } from '@js/utils';

const options = {
    item: 'js-faq-tabs',
    accordion: 'js-faq-list-accordion',
    list: '[data-js-tab=tablist]',
    wrapper: '[data-js-tab=tabwrapper]',
};

export default {
    init() {
        const tabs = document.querySelectorAll(`.${options.item}`);

        if (tabs.length > 0) {
            Array.prototype.forEach.call(tabs, (tabBlock) => {
                const tabs = tabBlock.querySelectorAll('[role="tab"]');
                const tabList = tabBlock.querySelector('[role="tablist"]');

                // Add first tab in list a active
                initTabs(tabs[0]);
                // Setup mobile click event
                toggleAccrodion();

                // Listen for resize and reset attributes as required
                window.addEventListener(
                    'resize',
                    throttle(() => {
                        initTabs(tabs[0]);
                    }, 100),
                    false
                );

                // Add a click event handler to each tab
                tabs.forEach((tab) => {
                    tab.addEventListener('click', (e) => {
                        changeTabs(e.target);
                    });
                });

                // Enable arrow navigation between tabs in the tab list
                let tabFocus = 0;

                tabList.addEventListener('keydown', (e) => {
                    // Move right
                    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                        tabs[tabFocus].setAttribute('tabindex', -1);
                        if (e.key === 'ArrowRight') {
                            tabFocus++;
                            // If we're at the end, go to the start
                            if (tabFocus >= tabs.length) {
                                tabFocus = 0;
                            }
                            // Move left
                        } else if (e.key === 'ArrowLeft') {
                            tabFocus--;
                            // If we're at the start, move to the end
                            if (tabFocus < 0) {
                                tabFocus = tabs.length - 1;
                            }
                        }

                        tabs[tabFocus].setAttribute('tabindex', 0);
                        tabs[tabFocus].focus();
                    }
                });
            });
        }
    },
};

const initTabs = (tab) => {
    const breakpoint = 1024;
    document.querySelectorAll(`.${options.accordion}`).forEach((wrapper) => {
        wrapper.setAttribute('aria-selected', false);
    });

    if (window.innerWidth < breakpoint) {
        hidePanels(tab);
    } else {
        changeTabs(tab);
    }
};

const toggleAccrodion = () => {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains(options.accordion)) {
            const wrapper = e.target.closest(options.wrapper);

            togglePanels(e.target, wrapper);
        }
    });
};

const changeTabs = (target) => {
    const list = target.closest(options.list);
    const wrapper = list.closest(options.wrapper);

    // Remove all current selected tabs
    list.querySelectorAll('[aria-selected="true"]').forEach((tab) => {
        tab.setAttribute('aria-selected', false);
        tab.setAttribute('tabindex', -1);
    });

    // Set this tab as selected
    target.setAttribute('aria-selected', true);
    target.setAttribute('tabindex', 0);

    // Hide all tab panels
    wrapper
        .querySelectorAll('[role="tabpanel"]')
        .forEach((panel) => panel.setAttribute('hidden', true));

    // Show the selected panel
    wrapper
        .querySelector(`[data-js-tab=${target.getAttribute('aria-controls')}]`)
        .removeAttribute('hidden');
};

const hidePanels = (target) => {
    const list = target.closest(options.list);
    const wrapper = list.closest(options.wrapper);
    // Hide all tab panels
    wrapper
        .querySelectorAll('[role="tabpanel"]')
        .forEach((panel) => panel.setAttribute('hidden', true));
};

const togglePanels = (target, wrapper) => {
    const expanded = target.getAttribute('aria-selected');
    const panelButton = wrapper.querySelector(
        `[data-js-tab=${target.getAttribute('aria-controls')}]`
    );

    if (expanded === 'true') {
        // Set this tab as selected
        target.setAttribute('aria-selected', false);
        // Hide the selected panel
        panelButton.setAttribute('hidden', true);
    } else {
        // Set this tab as selected
        target.setAttribute('aria-selected', true);
        // Show the selected panel
        panelButton.removeAttribute('hidden');
    }
};
