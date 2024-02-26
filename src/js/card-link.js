/**
 * Makes the whole card a link while keeping contextual link position.
 */

const options = {
    item: '.js-card-link',
};

const init = () => {
    const cards = document.querySelectorAll(options.item);

    if (cards.length > 0) {
        Array.prototype.forEach.call(cards, (card, i) => {
            let down;
            let up;
            let link = card.querySelector('a');

            card.style.cursor = 'pointer';

            link.onfocus = () => {
                cards[Number(i)].classList.add('has-focus');
            };

            link.onblur = () => {
                cards[Number(i)].classList.remove('has-focus');
            };

            card.onmousedown = () => {
                down = +new Date();
            };

            card.onmouseup = (e) => {
                if (e.button === 0) {
                    up = +new Date();
                    if (up - down < 200) {
                        link.click();
                    }
                }
            };
        });
    }
};

export default { init };
