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
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            colors: {
                boss: {
                    gold: '#C9A96E',
                    'gold-hover': '#B89058',
                    pink: '#F7D6E0',
                    dark: '#1A1A1A',
                    cream: '#F5EDE6',
                    muted: '#FAFAF8',
                },
            },
        },
    },

    plugins: [forms],
};
