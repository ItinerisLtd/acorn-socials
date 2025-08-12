<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Managers;

class ConfigManager
{
    public static function getSocials(): array
    {
        return config('acorn-socials.socials', []);
    }

    public static function getSharableAllowList(): array
    {
        $sharables = [];
        foreach (static::getSocials() as $key => $social) {
            if (empty($social) || true === ($social['sharable'] ?? true)) {
                $sharables[] = $key;
            }
        }
        return $sharables;
    }

    public static function getSocialPageAllowList(): array
    {
        $socials = [];
        foreach (static::getSocials() as $key => $social) {
            if (empty($social) || true === ($social['social'] ?? true)) {
                $socials[] = $key;
            }
        }
        return $socials;
    }
}
