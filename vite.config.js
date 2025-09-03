import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import { wordpressPlugin } from '@roots/vite-plugin';

export default defineConfig({
  base: '/public/build/',
  plugins: [
    laravel({
      input: [
        'resources/js/native.js',
        'resources/js/copy-to-clipboard.js',
      ],
      refresh: true,
    }),

    wordpressPlugin(),
  ],
  resolve: {
    alias: {
      '@scripts': '/resources/js',
    },
  }
})
