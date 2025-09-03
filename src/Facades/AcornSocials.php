<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getSocialPages()
 * @method static array getSharableSocials()
 * @method static \Itineris\AcornSocials\Managers\SocialsManager getSocialsManager()
 * @method static bool hasSocial(string $social)
 *
 * @see \Itineris\AcornSocials\AcornSocials
 */
class AcornSocials extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'AcornSocials';
    }
}
