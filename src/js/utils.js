const throttle = (fn, ms) => {
    let time;
    let last = 0;
    return () => {
        const a = arguments;
        const t = this;
        const now = +new Date();
        const exe = () => {
            last = now;
            fn.apply(t, a);
        };
        clearTimeout(time);
        now >= last + ms ? exe() : (time = setTimeout(exe, ms));
    };
};

const getNextSibling = (elem, selector) => {
    const sibling = elem.nextElementSibling;

    if (!selector) return sibling;

    while (sibling) {
        if (sibling.matches(selector)) return sibling;
        sibling = sibling.nextElementSibling;
    }
};

const formatValue = (value) => {
    return new Intl.NumberFormat('en-GB', {
        style: 'currency',
        currency: 'GBP',
        minimumFractionDigits: '0',
    }).format(value);
};

export { throttle, getNextSibling, formatValue };
