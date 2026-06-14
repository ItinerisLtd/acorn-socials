<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Contracts;

interface SectionRepositoryInterface
{
    public function setData(): array;

    public function getData(): mixed;

    public function getSharableSocials(): array;

    public function getSocialPages(): array;
}
