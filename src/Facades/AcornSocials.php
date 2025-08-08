<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getRegisteredNonSharableSocials()
 * @method static array getRegisteredSharableSocials()
 * @method static \Itineris\AcornSocials\Concretes\AbstractSection getSocialSection()
 * @method static \Itineris\AcornSocials\Concretes\AbstractSectionRepository getSectionRepository()
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
