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
                sans: ['Be Vietnam Pro', 'sans-serif'],
                serif: ['Be Vietnam Pro', 'serif'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')({
        strategy: 'class',
    })],
};
