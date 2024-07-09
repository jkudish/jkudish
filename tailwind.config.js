/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
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

