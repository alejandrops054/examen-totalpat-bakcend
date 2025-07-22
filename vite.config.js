import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel(['resources/js/app.js']), 
  ],
  build: {
    outDir: 'public/build',
  },
});
