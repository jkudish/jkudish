import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        assetsInlineLimit: 0,
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    // Separate Alpine into its own chunk for better caching
                    if (id.includes('alpinejs')) {
                        return 'alpine';
                    }
                    // Separate node_modules into vendor chunk
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }
                },
                chunkFileNames: 'assets/[name]-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
                hashCharacters: 'hex',
            }
        },
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                passes: 2,
            },
            mangle: {
                safari10: true,
            },
            format: {
                comments: false,
                ecma: 2015,
            },
        },
        cssMinify: true,
        reportCompressedSize: true,
        chunkSizeWarningLimit: 500,
        sourcemap: false, // Disable sourcemaps in production for smaller files
    },
    esbuild: {
        legalComments: 'none', // Remove all comments
    },
});
