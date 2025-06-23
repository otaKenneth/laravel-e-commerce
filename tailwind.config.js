const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                mainHeading: ['Montserrat', ...defaultTheme.fontFamily.sans],
                secondaryHeading: ['Lexend', ...defaultTheme.fontFamily.sans],
                body: ['Poppins', ...defaultTheme.fontFamily.sans]
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
