const options = {
    item: 'js-plsa-form',
    type: 'js-plsa-form-type',
    input: 'js-plsa-form-input',
    button: 'js-plsa-form-button',
};

export default {
    init() {
        const forms = document.querySelectorAll(`.${options.item}`);
        if (forms.length > 0) {
            forms.forEach((form) => {
                const type = form.querySelectorAll(`.${options.type}`);
                const brackets = JSON.parse(form.dataset.jsBrackets);
                const button = form.querySelectorAll(`.${options.button}`)[0];
                let inputs = form.querySelectorAll(`.${options.input}`);
                let average = 0;
                let isCouple = false;

                if (type.length > 0) {
                    type[0].addEventListener('change', (e) => {
                        const target = e.target;
                        const last = inputs[inputs.length - 1];

                        if (target.checked === true) {
                            isCouple = true;
                            last.classList.remove('hidden');
                            last.parentElement.classList.add('available');
                        } else if (target.checked === false) {
                            isCouple = false;
                            last.value = '';
                            last.classList.add('hidden');
                            last.parentElement.classList.remove('available');
                        }
                    });
                }

                if (inputs.length > 0) {
                    inputs.forEach((input) => {
                        input.value = '';
                        input.addEventListener('keyup', (e) => {
                            average = initValues(
                                brackets,
                                inputs,
                                button,
                                isCouple
                            );
                        });
                    });
                }
            });
        }
    },
};

const initValues = (brackets, inputs, button, couple) => {
    const average = getValues(inputs);
    const allBrackets = setBracket(brackets, average, inputs, couple);
    const bracket = allBrackets.bracketDetails[0];
    sessionStorage.isioBracket = '';
    sessionStorage.isioAverage = '';
    button.href = bracket.link;

    if (bracket.link !== '') {
        button.classList.remove('disabled');
    } else {
        button.classList.add('disabled');
    }
    sessionStorage.isioBracket = bracket.name;
    sessionStorage.isioAverage = average;

    return average;
};

const getValues = (inputs) => {
    let total = 0;

    inputs.forEach((input) => {
        if (input.value) {
            total = Number(input.value) + Number(total);
        }
    });

    return Math.round(Number(total));
};

const setBracket = (brackets, average, inputs, couple) => {
    let bracketLink = '';
    let bracketName = '';
    let bracketMin = '';
    let bracketDetails = [];

    const setBrackets = (name, link, min, results) => {
        results = [];
        bracketName = name;
        bracketLink = link ? link : '';
        bracketMin = min;
        results['name'] = bracketName;
        results['link'] = bracketLink;
        results['min'] = bracketMin;

        bracketDetails.push(results);
    };

    brackets.forEach((bracket) => {
        const name = bracket.name;
        const maxValue = Number(1000000 * 1000000);
        let link = bracket.link;
        let min = 0;
        let max = maxValue;
        let results = [];

        if (inputs.length > 1) {
            min = bracket.min ? bracket.min : 0;
            max = bracket.max ? bracket.max : maxValue;
            if (couple == true) {
                link = bracket.link_couple;
                min = bracket.min_couple ? bracket.min_couple : 0;
                max = bracket.max_couple ? bracket.max_couple : maxValue;
            }
        }

        if (average >= min) {
            if (average <= max) {
                setBrackets(name, link, min, results);
            }
        } else if (average < min) {
            setBrackets(name, link, min, results);
        }
    });

    return { bracketDetails };
};
