<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Providers;

use Illuminate\Support\ServiceProvider;
use Itineris\AcornSocials\Assets\ManifestHandler;
use Itineris\AcornSocials\Facades\AcornSocials;

use function Roots\asset;

class AssetsServiceProvider extends ServiceProvider
{
     /**
      * Register assets services.
      */
    public function register(): void
    {
        app('assets')->manifest(
            'acorn-socials',
            [
                'handler' => (new ManifestHandler())(),
                'path' => ITINERIS_ACORN_SOCIALS_PUBLIC_DIR . '/build',
                'url' => ITINERIS_ACORN_SOCIALS_PUBLIC_URI . '/build',
                'assets' => ITINERIS_ACORN_SOCIALS_PUBLIC_DIR . '/build/manifest.json',
            ],
        );

        add_action('wp_enqueue_scripts', function (): void {
            if (AcornSocials::hasSocial('native')) {
                wp_enqueue_script_module(
                    'acorn-socials/native',
                    asset('resources/js/native.js', 'acorn-socials')->uri(),
                    [],
                    null,
                );
            }

            if (AcornSocials::hasSocial('copy_to_clipboard')) {
                wp_enqueue_script_module(
                    'acorn-socials/copy-to-clipboard',
                    asset('resources/js/copy-to-clipboard.js', 'acorn-socials')->uri(),
                    [],
                    null,
                );
            }
        });
    }
}
