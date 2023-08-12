import { fileURLToPath, URL } from 'node:url'

import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig((cmd, mode) => {

    const env = loadEnv(mode, process.cwd(), '');
    return {
        transpileDependencies: true,
        resolve: {
            alias: {
            '@': fileURLToPath(new URL('./resources', import.meta.url))
            }
        },
        plugins: [
            laravel({
                input: [
                    'resources/main.js'
                ],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        // The Vue plugin will re-write asset URLs, when referenced
                        // in Single File Components, to point to the Laravel web
                        // server. Setting this to `null` allows the Laravel plugin
                        // to instead re-write asset URLs to point to the Vite
                        // server instead.
                        base: null,

                        // The Vue plugin will parse absolute URLs and treat them
                        // as absolute paths to files on disk. Setting this to
                        // `false` will leave absolute URLs un-touched so they can
                        // reference assets in the public directory as expected.
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        css: {
          loaderOptions: {
            sass: {
              additionalData: `
                @use "resources/assets/scss/colors.scss";
                @use "resources/assets/scss/constants.scss";
                @use "resources/assets/scss/fonts.scss";
                @use "resources/assets/scss/mixins.scss" as *;
              `
            }
          }
        }
    }
});
