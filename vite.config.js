// vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
    // Opciones de configuración
    server: {
        port: 3000,
    },
    build: {
        outDir: 'dist',
    }
});