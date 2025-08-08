<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Providers;

use Illuminate\Support\ServiceProvider;
use Itineris\AcornSocials\AcornSocials;
use Itineris\AcornSocials\Concretes\AbstractSection;
use Itineris\AcornSocials\Concretes\AbstractSectionRepository;
use Itineris\AcornSocials\Managers\ConfigManager;
use Itineris\AcornSocials\Managers\HookManager;
use Itineris\AcornSocials\Managers\SharableSocials;
use RuntimeException;

class AcornSocialsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $sectionClass = ConfigManager::getSocialSection();
        $repositoryClass = ConfigManager::getSocialSectionRepository();

        if (
            !is_subclass_of($sectionClass, AbstractSection::class)
            || !is_subclass_of($repositoryClass, AbstractSectionRepository::class)
        ) {
            throw new RuntimeException('Social section or repository class is not defined in the configuration.');
        }

        $this->app->singleton(
            'AcornSocials',
            function () use ($sectionClass, $repositoryClass) {
                return new AcornSocials(
                    $this->app,
                    new HookManager(),
                    new SharableSocials(),
                    new $sectionClass(),
                    new $repositoryClass(),
                );
            },
        );
    }

    /**
     * Bootstrap any application services.
     */
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
