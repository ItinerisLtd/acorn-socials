<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Concretes;

use Itineris\AcornSocials\Contracts\SectionInterface;
use Itineris\AcornSocials\Facades\AcornSocials;
use Itineris\AcornSocials\Managers\ConfigManager;
use Kirki\Section;

abstract class AbstractSection implements SectionInterface
{
    public const SECTION_ID = '';
    public const SECTION_TITLE = '';
    public const SECTION_DESCRIPTION = '';
    protected const PANEL = '';
    protected const PRIORITY = 10;

    public static function register(): void
    {
        if (!is_customize_preview()) {
            return;
        }
        $instance = new static();
        $instance->registerSection();
        $instance->registerFields();
    }

    protected function registerSection(): void
    {
        $this->shouldSectionBeAdded() && new Section(
            static::SECTION_ID,
            [
                'title' => static::SECTION_TITLE,
                'description' => static::SECTION_DESCRIPTION,
                'panel' => static::PANEL,
                'priority' => static::PRIORITY,
            ],
        );
    }

    protected function shouldSectionBeAdded(): bool
    {
        return !empty(static::SECTION_ID)
        && !empty(static::SECTION_TITLE);
    }

    protected function getSection(): string
    {
        return static::SECTION_ID;
    }

    protected function getSocialNameDropdown(): array
    {
        $socials = AcornSocials::getSocialsManager()->getDefinedSocials();

        $allowedSharables = ConfigManager::getSocials();
        if (!empty($allowedSharables)) {
            $socials = array_intersect_key($socials, array_flip(array_keys($allowedSharables)));
        }

        $dropdown = ['' => __('Select', 'itineris')];
        foreach ($socials as $key => $social) {
            if (empty($social['name'])) {
                continue;
            }
            $dropdown[$key] = $social['name'];
        }

        return $dropdown;
    }
}
