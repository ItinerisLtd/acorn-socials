<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Concretes;

use Itineris\AcornSocials\Contracts\SectionRepositoryInterface;

abstract class AbstractSectionRepository implements SectionRepositoryInterface
{
    protected mixed $data = null;

    public function getData(): array
    {
        if (!is_null($this->data) && is_array($this->data)) {
            return $this->data;
        }

        $this->data = $this->setData();

        return $this->data;
    }

    public function getSocialNames(bool $slugified = false): array
    {
        $data = $this->getData();
        if (empty($data) || !is_array($data)) {
            return [];
        }

        $names = array_column($data, 'name');
        if (!$slugified) {
            return $names;
        }

        return array_map(
            fn (string $name): string => sanitize_title($name),
            $names,
        );
    }
}
