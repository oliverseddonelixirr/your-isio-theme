import baseConfig from './tailwind-config/base-tailwind.config.js';

const themeColours = {};

module.exports = {
    content: baseConfig.content,
    theme: {
        container: {
            ...baseConfig.theme.container,
        },
        fontSize: {
            ...baseConfig.theme.fontSize,
        },
        borderWidth: {
            ...baseConfig.theme.borderWidth,
        },
        extend: {
            screens: { ...baseConfig.theme.extend.screens },
            height: { ...baseConfig.theme.extend.height },
            minHeight: { ...baseConfig.theme.extend.minHeight },
            width: { ...baseConfig.theme.extend.width },
            maxWidth: { ...baseConfig.theme.extend.maxWidth },
            colors: { ...baseConfig.theme.extend.colors, ...themeColours },
            borderWidth: { ...baseConfig.theme.extend.borderWidth },
            borderRadius: { ...baseConfig.theme.extend.borderRadius },
            boxShadow: { ...baseConfig.theme.extend.boxShadow },
            fontFamily: { ...baseConfig.theme.extend.fontFamily },
            keyframes: { ...baseConfig.theme.extend.keyframes },
            animation: { ...baseConfig.theme.extend.animation },
        },
    },
    ...baseConfig.plugins,
};
