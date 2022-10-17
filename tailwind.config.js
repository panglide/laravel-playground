const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    plugins: [
        require('@tailwindcss/forms'),
        plugin(function({ addComponents }) {
            addComponents({
                '.custom-input-group': {
                    position: 'relative',
                    display: 'inline-block'
                },
                '.custom-input-group-icon': {
                    position: 'absolute',
                    left: '0',
                    top: '0'
                },
                'input[type="text"].custom-input-group-text': {
                    paddingLeft: '4rem'
                }
            })
        })
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
};
