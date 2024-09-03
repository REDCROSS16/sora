import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import react from '@vitejs/plugin-react';

export default defineConfig({
    root: './',
    baseUrl: './',
    base: './',

    plugins: [
        react(),
        // symfonyPlugin(),
    ],
    // root: 'frontend/js',

    // build: {
    //     rollupOptions: {
    //         input: {
    //             app: "./assets/app.js"
    //         },
    //     }
    // },

    server: {

        // proxy: {
        //     '/': 'http://localhost:8080', // Замените на ваш URL Symfony
        // },

        https: false,
        host: true,
        strictPort: false,
        port: 3000,
        hmr: {
            host: 'localhost',
            protocol: 'ws'
        },
        watch: {
            usePolling: true,
        }
    },

    optimizeDeps: {
        exclude: ['framer-motion']
    }
});
