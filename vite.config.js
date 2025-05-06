// vite.config.js
import { defineConfig } from "vite";
import usePHP from "vite-plugin-php";

export default defineConfig({
  // Opciones de configuración
  plugins: [usePHP()], // Usar el plugin de PHP
  server: {
    port: 3000,
  },
  build: {
    outDir: "dist",
  },
});
