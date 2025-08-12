<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Providers;

use Illuminate\Support\ServiceProvider;
use Itineris\AcornSocials\AcornSocials;
use Itineris\AcornSocials\Integrations\Customizer\SocialsSectionRepository;
use Itineris\AcornSocials\Managers\HookManager;
use Itineris\AcornSocials\Managers\SocialsManager;

class AcornSocialsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->app->singleton(
            'AcornSocials',
            fn() => new AcornSocials(
                $this->app,
                new HookManager(),
                new SocialsManager(),
                new SocialsSectionRepository(),
            ),
        );
    }

    public function boot(): void
    {
        $this->bootPublishing();
        $this->app->make('AcornSocials');
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/acorn-socials.php',
            'acorn-socials',
        );
    }

    private function bootPublishing(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../../config/acorn-socials.php' => $this->app->configPath('acorn-socials.php'),
        ], 'config');
    }
}
