<?php

namespace Itineris\AcornSocials\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getQuote()
 *
 * @see \Itineris\AcornSocials\AcornSocials
 */
class AcornSocials extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'AcornSocials';
    }
}
