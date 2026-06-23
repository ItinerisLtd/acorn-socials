<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Support;

use Roots\Acorn\Application;

final class AcornCompatibility
{
    private function __construct()
    {
    }

    /**
     * @param array<class-string> $providers
     */
    public static function resolveApplication(array $providers = []): Application
    {
        if (function_exists('app')) {
            $app = app();
            if ($app instanceof Application) {
                self::registerProvidersIfNeeded($app, $providers);

                return $app;
            }
        }

        if (class_exists(Application::class) && method_exists(Application::class, 'configure')) {
            return Application::configure()
                ->withProviders($providers)
                ->boot();
        }

        if (! function_exists('Roots\bootloader')) {
            self::failMissingAcorn();
        }

        $bootloader = \Roots\bootloader();

        if ($bootloader instanceof Application) {
            self::registerProvidersIfNeeded($bootloader, $providers);

            return $bootloader;
        }

        if (is_object($bootloader) && method_exists($bootloader, 'getApplication')) {
            $app = $bootloader->getApplication();
            if ($app instanceof Application) {
                self::registerProvidersIfNeeded($app, $providers);

                return $app;
            }
        }

        self::failMissingAcorn();
    }

    private static function registerProvidersIfNeeded(Application $app, array $providers): void
    {
        foreach ($providers as $provider) {
            self::registerProviderIfNeeded($app, $provider);
        }
    }

    public static function registerProviderIfNeeded(Application $app, string $provider): void
    {
        if (method_exists($app, 'providerIsLoaded') && $app->providerIsLoaded($provider)) {
            return;
        }

        if (method_exists($app, 'getLoadedProviders')) {
            $loadedProviders = $app->getLoadedProviders();
            if (isset($loadedProviders[$provider])) {
                return;
            }
        }

        if (method_exists($app, 'getProvider') && null !== $app->getProvider($provider)) {
            return;
        }

        $app->register($provider);
    }

    public static function registerContainerAliasIfNeeded(Application $app, string $abstract, string $alias): void
    {
        if (method_exists($app, 'getAlias') && $app->getAlias($alias) === $abstract) {
            return;
        }

        $app->alias($abstract, $alias);
    }

    private static function failMissingAcorn(): never
    {
        wp_die(
            esc_html__('You need to install Acorn to use this site.', 'itineris'),
            '',
            [
                'link_url' => 'https://roots.io/acorn/docs/installation/',
                'link_text' => esc_html__('Acorn Docs: Installation', 'itineris'),
            ],
        );

        exit;
    }
}
