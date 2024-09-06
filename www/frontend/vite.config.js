import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    // root: './',
    // baseUrl: './',
    // base: './',

    plugins: [
        react(
        //     {
        //     jsxRuntime: 'classic'
        // }
        )
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
        // hmr: true,
        hmr: {
            host: 'localhost',
            protocol: 'ws'
        },
        watch: {
            usePolling: true
        }
    },

    optimizeDeps: {
        exclude: ['framer-motion']
    }
});
