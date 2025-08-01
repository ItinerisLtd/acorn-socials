<?php

namespace Itineris\AcornSocials\Providers;

use Illuminate\Support\ServiceProvider;
use Itineris\AcornSocials\Console\AcornSocialsCommand;
use Itineris\AcornSocials\AcornSocials;

class AcornSocialsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('AcornSocials', function () {
            return new AcornSocials($this->app);
        });

        $this->mergeConfigFrom(
            __DIR__.'/../../config/acorn-socials.php',
            'acorn-socials'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/acorn-socials.php' => $this->app->configPath('acorn-socials.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/acorn-package'),
        ], 'public');

        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'AcornSocials',
        );

        $this->commands([
            AcornSocialsCommand::class,
        ]);

        $this->app->make('AcornSocials');
    }
}
