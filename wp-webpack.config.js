const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const webpackAlias = require('./webpackAlias');

module.exports = {
    ...defaultConfig,
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
            {
                test: /\.svg$/,
                loader: 'svg-sprite-loader',
            },
        ],
    },
    resolve: {
        alias: webpackAlias,
    },
};
