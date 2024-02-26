/** @type {import('tailwindcss').Config} */

import { brand1, brandNeutral } from './colours-tailwind.config.js';

module.exports = {
    content: require('fast-glob').sync([
        './*.php',
        './partials/**/*.php',
        './inc/Blocks/**/*.php',
    ]),
    theme: {
        container: {
            center: true,
            screens: {
                '2xl': '1280px',
            },
        },
        fontSize: {
            'sm-light': [
                '16px',
                {
                    lineHeight: '140%',
                    fontWeight: '300',
                },
            ],
            sm: [
                '16px',
                {
                    lineHeight: '140%',
                    fontWeight: '400',
                },
            ],
            'sm-medium': [
                '16px',
                {
                    lineHeight: '140%',
                    fontWeight: '500',
                },
            ],
            'sm-semibold': [
                '16px',
                {
                    lineHeight: '140%',
                    fontWeight: '600',
                },
            ],
            'sm-bold': [
                '16px',
                {
                    lineHeight: '140%',
                    fontWeight: '600',
                },
            ],
            'base-light': [
                '19px',
                {
                    lineHeight: '140%',
                    fontWeight: '300',
                },
            ],
            base: [
                '19px',
                {
                    lineHeight: '140%',
                    fontWeight: '400',
                },
            ],
            'base-medium': [
                '19px',
                {
                    lineHeight: '140%',
                    fontWeight: '500',
                },
            ],
            'base-semibold': [
                '19px',
                {
                    lineHeight: '140%',
                    fontWeight: '600',
                },
            ],
            'base-bold': [
                '19px',
                {
                    lineHeight: '140%',
                    fontWeight: '600',
                },
            ],
            'lg-light': [
                '22px',
                {
                    lineHeight: '140%',
                    fontWeight: '300',
                },
            ],
            lg: [
                '22px',
                {
                    lineHeight: '140%',
                    fontWeight: '400',
                },
            ],
            'lg-medium': [
                '22px',
                {
                    lineHeight: '140%',
                    fontWeight: '500',
                },
            ],
            'lg-semibold': [
                '22px',
                {
                    lineHeight: '140%',
                    fontWeight: '600',
                },
            ],
            'lg-bold': [
                '22px',
                {
                    lineHeight: '140%',
                    fontWeight: '600',
                },
            ],
            'stand-first': [
                '30px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            'stand-first-mobile': [
                '28px',
                {
                    lineHeight: '130%',
                    fontWeight: '300',
                },
            ],
            'header-intro': [
                '24px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            'header-intro-mobile': [
                '20px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            'nav-text': [
                '18px',
                {
                    lineHeight: 'normal',
                    fontWeight: '500',
                },
            ],
            'tick-list': [
                '20px',
                {
                    lineHeight: '130%',
                    fontWeight: '300',
                },
            ],
            'tick-list-bold': [
                '20px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            'tab-label': [
                '22px',
                {
                    lineHeight: '125%',
                    fontWeight: '500',
                },
            ],
            xl: [
                '19px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            '2xl': [
                '20px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            '3xl': [
                '24px',
                {
                    lineHeight: '130%',
                    fontWeight: '500',
                },
            ],
            '4xl': [
                '36px',
                {
                    lineHeight: '125%',
                    fontWeight: 'var(--isio-font-heading-weight)',
                },
            ],
            '4xl-mobile': [
                '30px',
                {
                    lineHeight: '125%',
                    fontWeight: 'var(--isio-font-heading-weight)',
                },
            ],
            '5xl': [
                '56px',
                {
                    lineHeight: '125%',
                    fontWeight: 'var(--isio-font-heading-weight)',
                },
            ],
            '5xl-mobile': [
                '42px',
                {
                    lineHeight: '125%',
                    fontWeight: 'var(--isio-font-heading-weight)',
                },
            ],
            '6xl': [
                '46px',
                {
                    lineHeight: '125%',
                    fontWeight: 'var(--isio-font-heading-weight)',
                },
            ],
            '6xl-mobile': [
                '36px',
                {
                    lineHeight: '125%',
                    fontWeight: 'var(--isio-font-heading-weight)',
                },
            ],
        },
        borderWidth: {
            DEFAULT: '1px',
            0: '0',
            2: '2px',
            4: '4px',
            8: '8px',
            'header-top': 'var(--isio-header-border-top)',
            'header-bottom': 'var(--isio-header-border-bottom)',
            'header-banner-top': 'var(--isio-header-banner-border-top)',
            'header-banner-bottom': 'var(--isio-header-banner-border-bottom)',
        },
        extend: {
            screens: {
                xs: '360px',
            },
            height: {
                logo: 'var(--isio-logo-height)',
            },
            minHeight: {
                header: 'var(--isio-header-height)',
            },
            width: {
                logo: 'var(--isio-logo-width)',
            },
            maxWidth: {
                footer: 'var(--isio-footer-width)',
            },
            colors: {
                'brand-1': brand1,
                'brand-1-heading': brand1[40],
                'brand-1-active': brand1[20],
                'brand-1-hover': brand1[30],
                'brand-neutral': brandNeutral,
                'brand-nav': 'rgb(var(--isio-nav-colour) / <alpha-value>)',
                'brand-icon': brand1,
                'brand-input-border': brand1,
                'brand-section-background': brandNeutral[20],
                'brand-footer': brandNeutral[40],
                'brand-header-border':
                    'rgb(var(--isio-header-border-colour) / <alpha-value>)',
                'brand-header-bg':
                    'rgb(var(--isio-header-background) / <alpha-value>)',
                'brand-header-banner-border': 'transparent',
            },
            borderWidth: {
                5: '5px',
            },
            borderRadius: {
                'card-border-top-left': 'var(--isio-card-border-top-left)',
                'card-border-top-right': 'var(--isio-card-border-top-right)',
                'card-border-bottom-right':
                    'var(--isio-card-border-bottom-right)',
                'card-border-bottom-left':
                    'var(--isio-card-border-bottom-left)',
                'button-border-top-left': 'var(--isio-button-border-top-left)',
                'button-border-top-right':
                    'var(--isio-button-border-top-right)',
                'button-border-bottom-right':
                    'var(--isio-button-border-bottom-right)',
                'button-border-bottom-left':
                    'var(--isio-button-border-bottom-left)',
                'input-border-top-left': 'var(--isio-input-border-top-left)',
                'input-border-top-right': 'var(--isio-input-border-top-right)',
                'input-border-bottom-right':
                    'var(--isio-input-border-bottom-right)',
                'input-border-bottom-left':
                    'var(--isio-input-border-bottom-left)',
            },
            boxShadow: {
                card: '0 4px 20px 0 rgba(0 0 0 / 0.15);',
                'card-small': '0 4px 4px 0 rgb(0 0 0 / 0.15)',
            },
            fontFamily: {
                heading: 'var(--isio-font-heading)',
                stand_first: 'var(--isio-font-stand-first)',
                body: 'var(--isio-font-body)',
                button: 'var(--isio-font-button)',
            },
            keyframes: {
                bgZoomOut: {
                    '0%': { backgroundSize: '120%' },
                    '100%': { backgroundSize: '100%' },
                },
            },
            animation: {
                'background-zoom': 'bgZoomOut 3s ease-in-out',
            },
        },
    },
    plugins: [require('tailwind-scrollbar')],
};
