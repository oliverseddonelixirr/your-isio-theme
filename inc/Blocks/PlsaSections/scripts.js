import { formatValue } from '@js/utils';

const options = {
    item: 'js-section-title',
};

export default {
    init() {
        const items = document.querySelectorAll(`.${options.item}`);

        if (items.length > 0) {
            items.forEach((item) => {
                const average = sessionStorage.isioAverage
                    ? formatValue(sessionStorage.isioAverage)
                    : null;
                const bracket = sessionStorage.isioBracket;

                if (average) {
                    item.innerHTML = `This is what ${average} could get you`;
                }
            });
        }
    },
};
