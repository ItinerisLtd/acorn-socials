<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Integrations\Customizer;

use Itineris\AcornSocials\Concretes\AbstractSectionRepository;
use Itineris\AcornSocials\Managers\ConfigManager;

class SocialsSectionRepository extends AbstractSectionRepository
{
    public function setData(): array
    {
        $sectionClass = ConfigManager::getSocialSection();

        $socials = array_filter((array) get_theme_mod($sectionClass::SOCIAL_NETWORKS, []));
        if (empty($socials)) {
            return [];
        }

        $socials = array_filter(
            $socials,
            fn (array $social): bool => !empty($social['url']) && !empty($social['icon_name']),
        );

        return array_map(fn (array $social): object => (object) $social, $socials);
    }
}
