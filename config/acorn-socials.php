<?php

declare(strict_types=1);

use Itineris\AcornSocials\Integrations\Customizer\SocialsSection;
use Itineris\AcornSocials\Integrations\Customizer\SocialsSectionRepository;

return [

    /*
    |--------------------------------------------------------------------------
    | Acorn Socials Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration files provide a great way to customize your package.
    |
    | In most cases, you should provide sane defaults and publishing the config
    | should be optional.
    |
    | Here, we'll define a few inspirational quotes for use in our component
    | and console command.
    |
    */

    'settings' => [
        'use_customizer' => true,
    ],

    'social' => [
        'section' => SocialsSection::class,
        'repository' => SocialsSectionRepository::class,
    ],

];
