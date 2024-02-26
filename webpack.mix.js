let mix = require('laravel-mix');
const webpackAlias = require('./webpackAlias');

require('mix-tailwindcss');
require('laravel-mix-svg-sprite');
require('./webpackRules');

mix.alias(webpackAlias)
    .setPublicPath('dist')
    .setResourceRoot('../')
    .webpackRules()
    .options({
        terser: {
            extractComments: false,
        },
    });

mix.js('src/js/scripts.js', 'js').version();

mix.postCss('src/css/style.css', 'css').version();

mix.postCss('src/css/editor-style.css', 'css').version();

mix.svgSprite('src/icons', 'sprite.svg', {}, {}).version();
