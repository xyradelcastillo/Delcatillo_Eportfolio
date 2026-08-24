/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: [
                    '"Inter Variable"',
                    'ui-sans-serif',
                    'system-ui',
                    'sans-serif',
                ],
                display: [
                    '"Space Grotesk Variable"',
                    '"Inter Variable"',
                    'ui-sans-serif',
                    'system-ui',
                    'sans-serif',
                ],
            },
            boxShadow: {
                soft: '0 10px 40px -12px rgb(0 0 0 / 0.12)',
                'soft-dark': '0 10px 40px -12px rgb(0 0 0 / 0.6)',
            },
        },
    },
    plugins: [],
};
