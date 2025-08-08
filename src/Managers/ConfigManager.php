<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Managers;

class ConfigManager
{
    public static function getSocialSection(): ?string
    {
        return config('acorn-socials.social.section');
    }

    public static function getSocialSectionRepository(): ?string
    {
        return config('acorn-socials.social.repository');
    }
}
