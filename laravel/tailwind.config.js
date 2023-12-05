import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'mi-color': '#7FE8FF',
                'color-2': '#A8FFF5',
                'blanco': '#FFFFFF',
                'negro': '#000000',
                'gris': '#D9D9D9',
                'rojo': '#FF0000',
                'morado': '#5E17EB',
            },
        },
    },

    plugins: [forms],
};

