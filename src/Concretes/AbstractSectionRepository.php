<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Concretes;

use Itineris\AcornSocials\Contracts\SectionRepositoryInterface;

abstract class AbstractSectionRepository implements SectionRepositoryInterface
{
    private mixed $data = null;

    public function getData(): array
    {
        if (is_array($this->data)) {
            return $this->data;
        }

        $this->data = $this->setData();

        return $this->data;
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
