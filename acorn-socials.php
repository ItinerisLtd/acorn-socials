<?php

declare(strict_types=1);

/**
 * Plugin Name:       Acorn Socials
 * Description:       Social account and sharable social post links management via WordPress
 * Version:           0.6.1
 * Requires at least: 6.8
 * Requires PHP:      8.4
 * Author:            Itineris Ltd.
 * Text Domain:       itineris
 */

use Itineris\AcornSocials\Facades\AcornSocials as AcornSocialsFacade;
use Itineris\AcornSocials\Providers\AcornSocialsServiceProvider;
use Itineris\AcornSocials\Providers\AssetsServiceProvider;
use Itineris\AcornSocials\Support\AcornCompatibility;

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
    $app = AcornCompatibility::resolveApplication([
        AcornSocialsServiceProvider::class,
        AssetsServiceProvider::class,
    ]);

    AcornCompatibility::registerContainerAliasIfNeeded(
        $app,
        'AcornSocials',
        AcornSocialsFacade::class,
    );
}, 20);
