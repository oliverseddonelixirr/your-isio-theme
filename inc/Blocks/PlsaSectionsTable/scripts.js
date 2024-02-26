const options = {
    item: 'js-sections-table-col',
};

export default {
    init() {
        const items = document.querySelectorAll(`.${options.item}`);

        if (items.length > 0) {
            items.forEach((item) => {
                const column = item.dataset.jsBracket;
                const bracket = sessionStorage.isioBracket
                    ? sessionStorage.isioBracket
                    : null;

                if (bracket && bracket === column) {
                    console.log(column);
                    item.classList.add('current');
                }
            });
        }
    },
};
