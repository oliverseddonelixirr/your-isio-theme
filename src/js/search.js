import { getNextSibling } from '@js/utils';
/**
 * Displays the search bar.
 */

const options = {
    item: '.js-search-btn',
    form: '.js-search-form',
};

const init = () => {
    const search = document.querySelectorAll(options.item);

    if (search.length > 0) {
        Array.prototype.forEach.call(search, (btn) => {
            btn.addEventListener('click', () => {
                getNextSibling(btn, options.form).classList.toggle('dropdown');
            });

            window.addEventListener('scroll', () => {
                getNextSibling(btn, options.form).classList.remove('dropdown');
            });
        });
    }
};

export default { init };
