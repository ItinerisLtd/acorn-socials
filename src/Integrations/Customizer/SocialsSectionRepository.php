<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Integrations\Customizer;

use Itineris\AcornSocials\Concretes\AbstractSectionRepository;
use Itineris\AcornSocials\Facades\AcornSocials;

class SocialsSectionRepository extends AbstractSectionRepository
{
    public function setData(): array
    {
        $socials = array_filter((array) get_theme_mod(SocialsSection::SOCIAL_NETWORKS, []));
        if (empty($socials)) {
            return [];
        }

        $socials = array_filter(
            $socials,
            fn(array $social): bool =>  !empty($social['social_name']) && !empty($social['social_icon_name'])
                && (!empty($social['social_page_url']) || !empty($social['is_social_sharable'])),
        );

        $data = [];
        foreach ($socials as $social) {
            $data[$social['social_name']] = $social;
        }

        // Prevents to pops up error if key changes happens in future.
        $data = array_intersect_key(
            $data,
            AcornSocials::getSocialsManager()->getDefinedSocials(),
        );

        return $data;
    }

    public function getSharableSocials(): array
    {
        $socials = $this->getData();
        if (empty($socials)) {
            return [];
        }

        return array_filter(
            $socials,
            fn(array $social): bool => !empty($social['is_social_sharable']),
        );
    }

    public function getSocialPages(): array
    {
        $socials = $this->getData();
        if (empty($socials)) {
            return [];
        }

        return array_filter(
            $socials,
            fn(array $social): bool => !empty($social['social_page_url']),
        );
    }
}
