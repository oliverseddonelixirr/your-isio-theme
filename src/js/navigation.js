/**
 * Navigation
 */
import { throttle } from '@js/utils';

const options = {
    item: '.js-navigation',
    header: '.js-header',
    burger: '.js-navigation-burger',
    burgerIcon: '.js-navigation-burger-icon',
    subItem: '.js-navigation-sub-item',
};

const init = () => {
    const navigation = document.querySelector(options.item);

    if (navigation) {
        const header = document.querySelector(options.header);
        const navElements = navigation.querySelectorAll("a:not([href*='#'])");
        const headerElements = header.querySelectorAll(
            "a:not([href*='#'], .js-profile-btn), button, input"
        );
        const navLinks = Array.from(navElements).concat(
            Array.from(headerElements)
        );
        const links = document.querySelectorAll(
            "a:not([href*='#'], .js-profile-btn), button, input, textarea, checkbox, radio, iframe"
        );

        resetAttributes(navigation, links, navLinks);
        closeNavigation(navigation, navigation, links, navLinks);

        document.addEventListener('click', (e) => {
            const target = e.target;
            // Check if the burger navigation was clicked.
            if (
                target.matches(options.burger) ||
                target.matches(options.burgerIcon)
            ) {
                toggleAttributes(navigation, links, navLinks);
            }
        });

        window.addEventListener(
            'resize',
            throttle(() => resetAttributes(navigation, links, navLinks), 50)
        );
    }
};

export default { init };

/**
 * Close mobile nav if open when ESC key is pressed.
 * @param {navList} navList - Navigation element with active class
 * @param {navigation} navigation - Navigation link elements tabindex
 * @param {links} links - All link elements
 * @param {navLinks} navLinks - Navigation link elements
 */
const closeNavigation = (navList, navigation, links, navLinks) => {
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (navList.classList.contains('active')) {
                toggleAttributes(navigation, links, navLinks);
            }
        }
    });
};

/**
 * Resets aria and tabindex attributes for all page links and navigation links.
 * @param {navigation} navigation - Navigation link elements tabindex
 * @param {links} links - All link elements
 * @param {navLinks} navLinks - Navigation link elements
 */
const resetAttributes = (navigation, links, navLinks) => {
    const body = document.getElementsByTagName('body')[0];
    const header = document.querySelector(options.header);
    const burger = document.querySelector(options.burger);
    const pageWidth = 1024;

    if (Number(window.innerWidth) > Number(pageWidth)) {
        // Desktop view.
        linkIndex(links, '0', navLinks, '0');
        burger.setAttribute('tabindex', '-1');
    } else {
        // Mobile view.
        linkIndex(links, '0', navLinks, '-1');
        burger.setAttribute('tabindex', '0');
    }

    document.querySelector(options.burgerIcon).classList.remove('active');
    body.classList.remove('modal-open');
    header.classList.remove('active');
    navigation.classList.remove('active');

    if (Number(window.innerWidth) > Number(pageWidth)) {
        // Desktop view.
        navigation.setAttribute('aria-expanded', 'true');
        navigation.setAttribute('aria-hidden', 'false');
    } else if (Number(window.innerWidth) <= Number(pageWidth)) {
        // Mobile view.
        navigation.setAttribute('aria-expanded', 'false');
        navigation.setAttribute('aria-hidden', 'true');
    }
};

/**
 * Toggles aria and tabindex attributes for all page links and navigation links.
 * @param {navigation} navigation - Navigation link elements tabindex
 * @param {links} links - All link elements
 * @param {navLinks} navLinks - Navigation link elements
 */
const toggleAttributes = (navigation, links, navLinks) => {
    const body = document.getElementsByTagName('body')[0];
    const header = document.querySelector(options.header);
    const burger = document.querySelector(options.burger);

    document.querySelector(options.burgerIcon).classList.toggle('active');

    if (
        document.querySelector(options.burgerIcon).classList.contains('active')
    ) {
        // View with open menu.
        body.classList.add('modal-open');
        header.classList.add('active');
        navigation.classList.add('active');
        navigation.setAttribute('aria-expanded', 'true');
        navigation.setAttribute('aria-hidden', 'false');
        linkIndex(links, '-1', navLinks, '0');
        burger.setAttribute('tabindex', '0');
    } else {
        // View with closed menu.
        body.classList.remove('modal-open');
        header.classList.remove('active');
        navigation.classList.remove('active');
        navigation.setAttribute('aria-expanded', 'false');
        navigation.setAttribute('aria-hidden', 'true');
        linkIndex(links, '0', navLinks, '-1');
        burger.setAttribute('tabindex', '0');
    }
};

/**
 * Sets the tabindex for all page links and navigation links.
 * @param {links} links - All link elements
 * @param {linkIndex} linkIndex - Link elements tabindex
 * @param {navLinks} navLinks - Navigation link elements
 * @param {navIndex} navIndex - Navigation link elements tabindex
 */
const linkIndex = (links, linkIndex, navLinks, navIndex) => {
    links.forEach((elem) => {
        elem.setAttribute('tabindex', linkIndex);
    });

    navLinks.forEach((elem) => {
        elem.setAttribute('tabindex', navIndex);
    });
};
