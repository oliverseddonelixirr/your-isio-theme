import { throttle } from '@js/utils';

export default {
    init() {
        const hasClass = (el, cls) => {
            if (el.className.match(`(?:^|\\s)${cls}(?!\\S)`)) {
                return true;
            }
        };

        const addClass = (el, cls) => {
            if (!el.className.match(`(?:^|\\s)${cls}(?!\\S)`)) {
                el.className += ` ${cls}`;
            }
        };

        const elementFromTop = (
            elem,
            classToAdd,
            distanceFromTop,
            unit,
            delay
        ) => {
            const winY =
                window.innerHeight || document.documentElement.clientHeight;
            const elemLength = elem.length;
            let distTop;
            let distPercent;
            let distPixels;
            let distUnit;
            let i;

            for (let i = 0; i < elemLength; ++i) {
                distTop = elem[i].getBoundingClientRect().top;
                distPercent = Math.round((distTop / winY) * 100);
                distPixels = Math.round(distTop);
                distUnit = unit == 'percent' ? distPercent : distPixels;

                if (distUnit <= distanceFromTop) {
                    if (!hasClass(elem[i], classToAdd)) {
                        if (delay) {
                            setTimeout(() => {
                                addClass(elem[i], classToAdd);
                            }, delay * i);
                        } else {
                            addClass(elem[i], classToAdd);
                        }
                    }
                }
            }
        };

        const animationClasses = document.querySelectorAll(
            '.fade-in, .slide-in-left, .slide-in-right'
        );

        elementFromTop(animationClasses, 'active', 80, 'percent'); // as top of element hits top of viewport

        window.addEventListener(
            'scroll',
            throttle(() => {
                elementFromTop(animationClasses, 'active', 80, 'percent'); // as top of element hits top of viewport
            }, 100),
            false
        );

        const rowLoad = document.querySelectorAll('.row-load');

        const sliceIntoChunks = (arr, chunkSize) => {
            const res = [];
            for (let i = 0; i < arr.length; i += chunkSize) {
                const chunk = arr.slice(i, i + chunkSize);
                res.push(chunk);
            }
            return res;
        };

        for (let i = 0; i < rowLoad.length; i++) {
            // calc computed style
            const gridComputedStyle = window.getComputedStyle(rowLoad[i]);

            // items per row
            const perChunk = gridComputedStyle
                .getPropertyValue('grid-template-columns')
                .split(' ').length;

            // Convert htmlcollection to array
            const inputArray = [].slice.call(rowLoad[i].children);

            // Slice cols into rendered rows
            const rows = sliceIntoChunks(inputArray, perChunk);

            // loop the rows
            for (let r = 0; r < rows.length; r++) {
                elementFromTop(rows[r], 'active', 80, 'percent', 200);

                window.addEventListener(
                    'scroll',
                    throttle(() => {
                        elementFromTop(rows[r], 'active', 80, 'percent', 200);
                    }, 100),
                    false
                );
            }
        }
    },
};
