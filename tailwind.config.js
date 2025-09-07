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
            },
            animation: {
                'slide-up': 'slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'fade-in': 'fade-in 0.8s ease-out forwards',
                'scale-in': 'scale-in 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                'float': 'float 3s ease-in-out infinite',
                'wave': 'wave 2.5s ease-in-out infinite',
                'gradient-shift': 'gradient-shift 3s ease infinite',
                'glow-pulse': 'glow-pulse 2s ease-in-out infinite',
                'typing': 'typing 3.5s steps(40, end)',
                'blink': 'blink 1s infinite',
                'rotate-border': 'rotate-border 3s linear infinite',
                'pulse-dot': 'pulse-dot 2s ease-in-out infinite',
                'bounce-slow': 'bounce 3s infinite',
                'spin-slow': 'spin 3s linear infinite',
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
                'scale-in': {
                    'from': { transform: 'scale(0.95)', opacity: '0' },
                    'to': { transform: 'scale(1)', opacity: '1' }
                },
                'float': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' }
                },
                'wave': {
                    '0%, 100%': { transform: 'rotate(0deg)' },
                    '25%': { transform: 'rotate(20deg)' },
                    '75%': { transform: 'rotate(-20deg)' }
                },
                'gradient-shift': {
                    '0%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                    '100%': { backgroundPosition: '0% 50%' }
                },
                'glow-pulse': {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                    '50%': { boxShadow: '0 0 30px rgba(59, 130, 246, 0.8), 0 0 60px rgba(59, 130, 246, 0.4)' }
                },
                'typing': {
                    'from': { width: '0' },
                    'to': { width: '100%' }
                },
                'blink': {
                    '0%, 50%': { opacity: '1' },
                    '51%, 100%': { opacity: '0' }
                },
                'rotate-border': {
                    '0%': { transform: 'rotate(0deg)' },
                    '100%': { transform: 'rotate(360deg)' }
                },
                'pulse-dot': {
                    '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                    '50%': { transform: 'scale(1.5)', opacity: '0.5' }
                }
            },
            colors: {
                'gradient': {
                    'cyan': '#06b6d4',
                    'blue': '#3b82f6',
                    'purple': '#8b5cf6',
                    'pink': '#ec4899',
                }
            },
            backgroundImage: {
                'gradient-primary': 'linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%)',
                'gradient-accent': 'linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%)',
                'gradient-rainbow': 'linear-gradient(45deg, #06b6d4, #3b82f6, #8b5cf6, #ec4899)',
                'mesh-gradient': 'radial-gradient(at 40% 20%, hsla(189, 100%, 56%, 0.15) 0px, transparent 50%), radial-gradient(at 80% 0%, hsla(355, 100%, 93%, 0.15) 0px, transparent 50%), radial-gradient(at 0% 50%, hsla(270, 100%, 77%, 0.15) 0px, transparent 50%)',
                'dots-pattern': 'radial-gradient(circle at 1px 1px, rgb(209 213 219 / 0.3) 1px, transparent 1px)',
                'grid-pattern': 'linear-gradient(rgba(0,0,0,.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,.03) 1px, transparent 1px)',
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

