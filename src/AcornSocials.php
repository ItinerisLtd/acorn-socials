<?php

declare(strict_types=1);

namespace Itineris\AcornSocials;

use Itineris\AcornSocials\Concretes\AbstractSection;
use Itineris\AcornSocials\Concretes\AbstractSectionRepository;
use Itineris\AcornSocials\Managers\HookManager;
use Itineris\AcornSocials\Managers\SharableSocials;
use Roots\Acorn\Application;

final class AcornSocials
{
    private ?array $registeredNonSharableSocials = null;

    /**
     * Create a new AcornSocials instance.
     */
    public function __construct(
        protected Application $app,
        protected HookManager $hookManager,
        protected SharableSocials $sharableSocials,
        protected AbstractSection $socialSection,
        protected AbstractSectionRepository $sectionRepository
    ) {
        $this->hookManager->registerHooks();
    }

    /**
     * Get socials like as page registered customizer.
     */
    public function getRegisteredNonSharableSocials(): array
    {
        if (is_array($this->registeredNonSharableSocials)) {
            return $this->registeredNonSharableSocials;
        }

        $sharableSocials = $this->getRegisteredSharableSocials();

        $onlySharableSocials = array_filter(
            $sharableSocials,
            fn (array $social): bool => $social['only_sharable'] ?? false,
        );

        $onlySharableSocialKeys = array_column($onlySharableSocials, 'key',);

        /**
         * Get all registered socials that are not sharable.
         */
        $this->registeredNonSharableSocials = array_filter(
            $this->sectionRepository->getData(),
            fn (object $social): bool => !in_array(sanitize_title($social->name), $onlySharableSocialKeys, true),
        );

        return $this->registeredNonSharableSocials;
    }

    /**
     * Get sharable socials registered customizer.
     */
    public function getRegisteredSharableSocials(): array
    {
        $socialNames = $this->sectionRepository->getSocialNames(true);
        return array_filter(
            $this->sharableSocials->getSharableSocials(),
            fn (array $social): bool => in_array($social['key'], $socialNames, true),
        );
    }

    public function getSocialSection(): AbstractSection
    {
        return $this->socialSection;
    }

    public function getSectionRepository(): AbstractSectionRepository
    {
        return $this->sectionRepository;
    }

    protected function getSharableSocials(): SharableSocials
    {
        return $this->sharableSocials;
    }
}
