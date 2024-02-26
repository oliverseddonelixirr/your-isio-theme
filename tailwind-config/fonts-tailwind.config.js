import defaultTheme from 'tailwindcss/defaultTheme';

const fonts = {
    'font-1': ['var(--isio-font-1)', ...defaultTheme.fontFamily.sans],
    'font-2': ['var(--isio-font-2)', ...defaultTheme.fontFamily.sans],
};

export { fonts };
