import { formatValue } from '@js/utils';

const options = {
    wrapper: 'js-section-form',
    item: 'js-value-form',
    input: 'js-value-duration',
    total: 'js-value-duration-total',
    formtotal: 'js-value-duration-formtotal',
    formprojected: 'js-value-duration-formprojected',
    projected: 'js-value-duration-projected',
    grandtotal: 'js-value-duration-grandtotal',
    resulttext: 'js-value-duration-resulttext',
    resultvalue: 'js-value-duration-resultvalue',
    icon: 'js-value-duration-icon',
};

export default {
    init() {
        const wrapper = document.querySelectorAll(`.${options.wrapper}`);

        if (wrapper.length > 0) {
            wrapper.forEach((item) => {
                const forms = item.querySelectorAll(`.${options.item}`);
                const grandtotal = item.querySelectorAll(
                    `.${options.grandtotal}`
                )[0];
                const resulttext = item.querySelectorAll(
                    `.${options.resulttext}`
                )[0];
                const resultvalue = item.querySelectorAll(
                    `.${options.resultvalue}`
                )[0];
                const icon = item.querySelectorAll(`.${options.icon}`)[0];
                const formprojected = item.querySelectorAll(
                    `.${options.formprojected}`
                )[0];
                const projected = item.querySelectorAll(
                    `.${options.projected}`
                )[0];
                const sessionAverage = sessionStorage.isioAverage;

                if (sessionAverage) {
                    formprojected.value = sessionAverage;
                }

                if (projected) {
                    projected.innerHTML = formatValue(
                        Number(formprojected.value)
                    );
                }

                if (forms.length > 0) {
                    forms.forEach((form) => {
                        const inputs = form.querySelectorAll(
                            `.${options.input}`
                        );
                        const total = form.querySelectorAll(
                            `.${options.total}`
                        )[0];
                        const formtotal = form.querySelectorAll(
                            `.${options.formtotal}`
                        )[0];
                        let average = 0;

                        initValues(
                            forms,
                            inputs,
                            formprojected,
                            average,
                            formtotal,
                            total,
                            grandtotal,
                            resulttext,
                            resultvalue,
                            icon
                        );

                        if (inputs.length > 0) {
                            inputs.forEach((input) => {
                                input.addEventListener('keyup', () => {
                                    initValues(
                                        forms,
                                        inputs,
                                        formprojected,
                                        average,
                                        formtotal,
                                        total,
                                        grandtotal,
                                        resulttext,
                                        resultvalue,
                                        icon
                                    );
                                });
                            });
                        }
                    });
                }
            });
        }
    },
};

const initValues = (
    forms,
    inputs,
    formprojected,
    average,
    formtotal,
    total,
    grandtotal,
    resulttext,
    resultvalue,
    icon
) => {
    average = getValues(inputs);
    formtotal.value = average;
    total.innerHTML = formatValue(average);
    grandtotal.innerHTML = formatValue(setGrandTotal(forms));
    resulttext.innerHTML = setResultTotal(
        setGrandTotal(forms),
        Number(formprojected.value)
    ).text;
    resultvalue.innerHTML = setResultTotal(
        setGrandTotal(forms),
        Number(formprojected.value)
    ).value;
    icon.classList.remove('hidden', 'down', 'up');
    icon.classList.add(
        setResultTotal(setGrandTotal(forms), Number(formprojected.value)).icon
    );
};

const getValues = (inputs) => {
    let total = 0;

    inputs.forEach((input) => {
        if (input.value) {
            total =
                Number(monthlyCost(input.dataset.jsDuration, input.value)) +
                Number(total);
        }
    });

    return Math.round(Number(total));
};

const setGrandTotal = (forms) => {
    let grandtotal = 0;

    forms.forEach((form) => {
        const totals = form.querySelectorAll(`.${options.formtotal}`);

        totals.forEach((total) => {
            if (total.value) {
                grandtotal = Number(total.value) + Number(grandtotal);
            }
        });
    });

    return Math.round(Number(grandtotal) * 12);
};

const setResultTotal = (total, projected) => {
    const calctotal = Number(projected) - Number(total);
    let response = { text: '', value: 0 };

    if (calctotal < 0) {
        response.text = 'You are below your target by:';
        response.value = formatValue(
            Math.round(Number(projected) - Number(total))
        );
        response.icon = 'down';
    }

    if (calctotal > 0) {
        response.text = 'You are above your target by:';
        response.value = formatValue(Math.round(Number(calctotal)));
        response.icon = 'up';
    }

    if (calctotal === 0) {
        response.text = 'You are matching your target.';
        response.icon = 'hidden';
    }

    return response;
};

const monthlyCost = (duration, value) => {
    let amount = 0;

    switch (duration) {
        case 'year':
            amount = Number(value) / 12;
            break;
        case 'week':
            amount = Number(value) * (52 / 12);
            break;
        default:
            amount = value;
    }

    return amount;
};
