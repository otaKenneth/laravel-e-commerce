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
                heading: ['Montserrat', defaultTheme.fontFamily.sans],
                subHeading: ['Lexend Deca', defaultTheme.fontFamily.sans],
                body: ['Poppins', defaultTheme.fontFamily.sans],
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            color: {
                primary: '#ED1C24',
                primaryHighlight: '#1f1f22',
                primaryBackground: '#f9f9f9'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
