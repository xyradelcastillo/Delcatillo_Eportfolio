/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            /* The whole UI references these shades; their actual values come
               from CSS variables (--accent-*) so the accent color can be
               switched at runtime via [data-accent] on <html>. */
            colors: {
                indigo: {
                    50: 'rgb(var(--accent-wash) / <alpha-value>)',
                    100: 'rgb(var(--accent-wash) / <alpha-value>)',
                    200: 'rgb(var(--accent-wash) / <alpha-value>)',
                    300: 'rgb(var(--accent-400) / <alpha-value>)',
                    400: 'rgb(var(--accent-400) / <alpha-value>)',
                    500: 'rgb(var(--accent-500) / <alpha-value>)',
                    600: 'rgb(var(--accent-600) / <alpha-value>)',
                    700: 'rgb(var(--accent-600) / <alpha-value>)',
                },
            },
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
