import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/client.css', 'resources/js/client.js',
                'resources/css/admin.css', 'resources/js/admin.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
