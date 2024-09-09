import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
	plugins: [
		react()
		// symfonyPlugin(),
	],
	server: {
		https: false,
		host: true,
		strictPort: false,
		port: 3000,
		hmr: {
			host: 'localhost',
			protocol: 'ws'
		},
		watch: {
			usePolling:true
		}

		// proxy: {
		//     '/': 'http://localhost:8080', // Замените на ваш URL Symfony
		// }
	},

	optimizeDeps: {
		exclude: ['framer-motion']
	}
});
