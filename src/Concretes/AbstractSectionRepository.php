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
}
