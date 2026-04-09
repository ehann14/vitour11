import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/splash.css',
                'resources/js/splash.js',
            ],
            refresh: true,
        }),
    ],
});