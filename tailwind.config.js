const plugin = require('@tailwindcss/forms');
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    plugins: [
        require("daisyui"),
        require("flowbite/plugin"),
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            width: {
                '500': '500px',
                '400': '400px',
                '300': '300px',
                '250': '250px',
                '200': '200px',
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                appBackground: '#F3F2EF',
                redButtons: '#BF2525',
                greenButtons:'#09814A',
                blueButtons: '#7699D4',
                accentWhite: '#D9D9D9',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
