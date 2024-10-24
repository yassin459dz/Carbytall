import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
              "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            // darkMode: 'class', // or 'media' for automatic dark mode based on system preferences

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms,
        require('flowbite/plugin'),
    ],
    // darkMode: 'class' // Just add this line at the bottom.

};