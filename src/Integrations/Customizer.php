<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Integrations;

use Itineris\AcornSocials\Concretes\AbstractSection;
use Itineris\AcornSocials\Contracts\IntegrationInterface;
use Itineris\AcornSocials\Managers\ConfigManager;

final class Customizer implements IntegrationInterface
{
    public static function register(): void
    {
        if (!static::shouldRegister()) {
            return;
        }

        $instance = new self();
        $instance->registerSection();
    }

    protected function registerSection(): void
    {
        $section = ConfigManager::getSocialSection();
        if (!is_subclass_of($section, AbstractSection::class)) {
            return;
        }
        $section::register();
    }

    public static function shouldRegister(): bool
    {
        return class_exists('Kirki\Compatibility\Kirki');
    }
}
