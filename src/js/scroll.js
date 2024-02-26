const elementsToAnimate = document.querySelectorAll('.js-animate-me');

const init = () => {
    // Smooth scroll to anchor
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            // Get the target element
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);

            // Calculate position to scroll to, accounting for the floating navigation
            const position =
                target.getBoundingClientRect().top + window.scrollY - 50;

            // Scroll to the target position
            window.scrollTo({
                top: position,
                behavior: 'smooth',
            });

            // Update the URL hash using history API to prevent the default jumping behavior
            if (history.pushState) {
                history.pushState(null, null, targetId);
            } else {
                location.hash = targetId;
            }
        });
    });

    // Event listener for scroll
    window.addEventListener('scroll', runOnScroll);
    window.addEventListener('load', runOnScroll);
};

export default { init };

const isInViewport = (el) => {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= -100 &&
        rect.bottom <=
            (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <=
            (window.innerWidth || document.documentElement.clientWidth)
    );
};

const getNumber = (value) => {
    if (typeof value === 'object' && value[1] !== undefined) {
        let returnValue = parseFloat(value[1]);
        if (typeof returnValue === 'number' && !isNaN(returnValue)) {
            return returnValue;
        }
    }
    return 0;
};

// Function to extract the step value from the class name
const getStepValue = (className) => {
    const result = /step-(\d+)/.exec(className);
    return getNumber(result);
};

const runOnScroll = () => {
    elementsToAnimate.forEach((el) => {
        if (isInViewport(el)) {
            let stepValue = 0;
            el.classList.forEach((cls) => {
                if (cls.startsWith('step-')) {
                    stepValue = getStepValue(cls);
                }
            });
            if (stepValue > 0) {
                setTimeout(() => {
                    el.classList.add('in-view');
                }, stepValue * 75);
            } else {
                el.classList.add('in-view');
            }
        }
    });
};
