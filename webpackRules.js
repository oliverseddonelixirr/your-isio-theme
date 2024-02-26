let mix = require('laravel-mix');
const { resolve } = require('path');

const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');

class WebpackRules {
    webpackPlugins() {
        return [
            new CleanWebpackPlugin({
                cleanOnceBeforeBuildPatterns: [resolve('dist/**/*')],
            }),
            new CopyWebpackPlugin({
                patterns: [
                    {
                        from: 'src/img',
                        to: 'img',
                    },
                ],
            }),
            new ImageMinimizerPlugin({
                minimizer: {
                    implementation: ImageMinimizerPlugin.imageminMinify,
                    options: {
                        plugins: [
                            'imagemin-gifsicle',
                            'imagemin-mozjpeg',
                            'imagemin-pngquant',
                            [
                                'svgo',
                                {
                                    plugins: [
                                        {
                                            name: 'preset-default',
                                            params: {
                                                overrides: {
                                                    removeViewBox: false,
                                                    addAttributesToSVGElement: {
                                                        params: {
                                                            attributes: [
                                                                {
                                                                    xmlns: 'http://www.w3.org/2000/svg',
                                                                },
                                                            ],
                                                        },
                                                    },
                                                },
                                            },
                                        },
                                    ],
                                },
                            ],
                        ],
                    },
                },
            }),
        ];
    }

    webpackRules() {
        return [
            {
                test: /\.css/,
                use: [
                    {
                        loader: 'postcss-loader',
                        options: {},
                    },
                ],
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env'],
                            cacheDirectory: true,
                            sourceMap: true,
                        },
                    },
                ],
            },
        ];
    }
}

mix.extend('webpackRules', new WebpackRules());
