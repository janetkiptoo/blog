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
                    

                    DEFAULT: '#001233',
                    50: "#EDF0FF",
      100: "#DEE4FF",
      200: "#B8C7FF",
      300: "#93AEFF",
      400: "#6492FF",
      500: "#1979FF",
      600: "#0063D7",
      700: "#004CA9",
      800: "#003880",
      900: "#002356",
      950: "#001C47"
                },
            },
        },
    },
    

    plugins: [forms],
};
