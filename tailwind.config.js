import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';



/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/js/**/*.js",
        "./resources/css/**/*.css",
    ],

    theme: {

        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#001233',
                    100: '#1D4ED8',
                    200: '#0466c8',
                },
            },
        },
    },
    

    plugins: [forms],
};
