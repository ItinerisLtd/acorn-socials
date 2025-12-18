<?php

declare(strict_types=1);

/**
 * Plugin Name:       Acorn Socials
 * Description:       Social account and sharable social post links management via WordPress
 * Version:           0.3.0
 * Requires at least: 6.8
 * Requires PHP:      8.2
 * Author:            Itineris Ltd.
 * Text Domain:       itineris
 */

// Composer is only used for local development and testing.
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

define('ITINERIS_ACORN_SOCIALS_SLUG', basename(__DIR__));
define('ITINERIS_ACORN_SOCIALS_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));
define('ITINERIS_ACORN_SOCIALS_SRC_DIR', ITINERIS_ACORN_SOCIALS_PLUGIN_DIR . '/src');
define('ITINERIS_ACORN_SOCIALS_PUBLIC_DIR', ITINERIS_ACORN_SOCIALS_PLUGIN_DIR . '/public');
define('ITINERIS_ACORN_SOCIALS_PUBLIC_URI', plugin_dir_url(__FILE__) . 'public');

add_action('after_setup_theme', function (): void {
    if (! function_exists('Roots\bootloader')) {
        wp_die(
            __('You need to install Acorn to use this site.', 'itineris'),
            '',
            [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'itineris'),
            ],
        );
    }

    $app = Roots\bootloader()->getApplication();

    $app->register(Itineris\AcornSocials\Providers\AcornSocialsServiceProvider::class);
    $app->register(Itineris\AcornSocials\Providers\AssetsServiceProvider::class);
    $app->alias('AcornSocials', Itineris\AcornSocials\Facades\AcornSocials::class);
}, 20);
