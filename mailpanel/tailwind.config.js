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
    // 1) Añadimos un breakpoint xs a 550px, 
    //    y desplegamos todos los breakpoints por defecto:
    screens: {
      xs: '550px',
      ...defaultTheme.screens,
    },

    // 2) Extendemos el theme como antes
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  plugins: [forms],
};
