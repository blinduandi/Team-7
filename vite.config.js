import { defineConfig, transformWithEsbuild } from 'vite'
import react from '@vitejs/plugin-react'
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),
<<<<<<< Updated upstream
=======

        // Workaround
        {
        name: 'load+transform-js-files-as-jsx',
        async transform(code, id) {
            if (!id.match(/src\/.*\.js$/)) {
            return null;
            }

            // Use the exposed transform from vite, instead of directly
            // transforming with esbuild
            return transformWithEsbuild(code, id, {
            loader: 'jsx',
            jsx: 'automatic', // 👈 this is important
            });
        },
        },
>>>>>>> Stashed changes
    ],
    optimizeDeps: {
        esbuildOptions: {
          loader: {
            '.js': 'jsx',
          },
        },
      },
});
