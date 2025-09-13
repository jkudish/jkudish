/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    darkMode: 'selector',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['"muliregular"', ...defaultTheme.fontFamily.sans],
                'title': ['"Telegraf UltraBold"', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'slide-up': 'slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'fade-in': 'fade-in 0.8s ease-out forwards',
            },
            keyframes: {
                'slide-up': {
                    'from': { transform: 'translateY(20px)', opacity: '0' },
                    'to': { transform: 'translateY(0)', opacity: '1' }
                },
                'fade-in': {
                    'from': { opacity: '0' },
                    'to': { opacity: '1' }
                },
            },
            colors: {
                'gradient': {
                    'cyan': '#047857',
                    'blue': '#065f46',
                    'purple': '#8b5cf6',
                    'pink': '#ec4899',
                }
            },
            backgroundImage: {
                'gradient-primary': 'linear-gradient(135deg, #047857 0%, #065f46 100%)',
                'gradient-rainbow': 'linear-gradient(45deg, #047857, #065f46, #8b5cf6, #ec4899)',
                'mesh-gradient': 'radial-gradient(at 40% 20%, hsla(189, 100%, 56%, 0.15) 0px, transparent 50%), radial-gradient(at 80% 0%, hsla(355, 100%, 93%, 0.15) 0px, transparent 50%), radial-gradient(at 0% 50%, hsla(270, 100%, 77%, 0.15) 0px, transparent 50%)',
            },
            transitionTimingFunction: {
                'bounce-in': 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                'smooth': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
            scale: {
                '102': '1.02',
                '103': '1.03',
            }
        },
    },
    plugins: [],
}

