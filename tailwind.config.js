/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    darkMode: 'selector',
    content: [
        "./resources/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['"muliregular"', ...defaultTheme.fontFamily.sans],
                'title': ['"Telegraf UltraBold"', ...defaultTheme.fontFamily.sans],
            }
        },
    },
    plugins: [],
}

