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
        $this->app->singleton(
            'AcornSocials',
            fn() => new AcornSocials(
                $this->app,
                new HookManager(),
                new SocialsManager(),
                new SocialsSectionRepository(),
            ),
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/acorn-socials.php',
            'acorn-socials',
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/acorn-socials.php' => $this->app->configPath('acorn-socials.php'),
        ], 'config');

        $this->app->make('AcornSocials');
    }
}
