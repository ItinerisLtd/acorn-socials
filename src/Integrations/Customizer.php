<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Integrations;

use Itineris\AcornSocials\Contracts\IntegrationInterface;
use Itineris\AcornSocials\Integrations\Customizer\SocialsSection;

final class Customizer implements IntegrationInterface
{
    public static function register(): void
    {
        static::shouldRegister() &&  SocialsSection::register();
    }

    public static function shouldRegister(): bool
    {
        return class_exists('Kirki\Compatibility\Kirki');
    }
}
