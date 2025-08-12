<?php

declare(strict_types=1);

namespace Itineris\AcornSocials;

use Itineris\AcornSocials\Integrations\Customizer\SocialsSectionRepository;
use Itineris\AcornSocials\Managers\HookManager;
use Itineris\AcornSocials\Managers\SocialsManager;
use Roots\Acorn\Application;

final class AcornSocials
{
    private ?array $socialPages = null;

    private ?array $sharableSocialPages = null;

    public function __construct(
        protected Application $app,
        protected HookManager $hookManager,
        protected SocialsManager $socialsManager,
        protected SocialsSectionRepository $socialsSectionRepository
    ) {
        $this->hookManager->registerHooks();
    }

    public function getSocialPages(): array
    {
        $socialPages = $this->socialsSectionRepository->getSocialPages();
        return $this->socialPages ??= $this->socialsManager->getSocialPages($socialPages);
    }

    public function getSharableSocials(): array
    {
        $sharableSocials = $this->socialsSectionRepository->getSharableSocials();
        return $this->sharableSocialPages ??= $this->socialsManager->getSharableSocials($sharableSocials);
    }

    public function getSocialsManager(): SocialsManager
    {
        return $this->socialsManager;
    }
}
