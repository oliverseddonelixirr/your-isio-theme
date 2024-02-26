/** @type {import('postcss-load-config').Config} */
module.exports = {
    plugins: [
        require('postcss-import-ext-glob'),
        require('postcss-import'),
        require('postcss-custom-properties'),
        require('@tailwindcss/nesting'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]
}
