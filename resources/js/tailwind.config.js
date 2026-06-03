/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#10b981',
                secondary: '#f3f4f6',
            }
        },
    },
    plugins: [],
}
