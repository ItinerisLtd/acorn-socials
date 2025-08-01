<?php

namespace Itineris\AcornSocials\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
     /**
     * Register assets services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Inject styles into the block editor.
         *
         * @return array
         */
        add_filter('block_editor_settings_all', function ($settings) {
            $style = Vite::asset('resources/css/editor.css');

            $settings['styles'][] = [
                'css' => Vite::isRunningHot()
                    ? "@import url('{$style}')"
                    : Vite::content('resources/css/editor.css'),
            ];

            return $settings;
        });

        /**
         * Inject scripts into the block editor.
         *
         * @return void
         */
        add_filter('admin_head', function () {
            if (! get_current_screen()?->is_block_editor()) {
                return;
            }

            $dependencies = json_decode(Vite::content('editor.deps.json'));

            foreach ($dependencies as $dependency) {
                if (! wp_script_is($dependency)) {
                    wp_enqueue_script($dependency);
                }
            }

            echo Vite::withEntryPoints([
                'resources/js/editor.js',
            ])->toHtml();
        });
    }
}
