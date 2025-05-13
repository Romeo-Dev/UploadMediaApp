import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        strictPort: true,
        port: 5173,
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
        watch: {
            ignored: ['./app/**', './bootstrap/**', './config/**', './database/**', './lang/**', './node_modules/**', './public/**', './routes/**', './storage/**', './tests/**', './vendor/**'],
        },
    },
    cors: {
      origin: /^https?:\/\/([A-Za-z0-9-.]+)?(localhost|\.test)(?::\d+)?$/,
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
});
