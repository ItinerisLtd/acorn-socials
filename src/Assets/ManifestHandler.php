<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Assets;

use Roots\Acorn\Application;

class ManifestHandler
{
    public function __invoke(): ?string
    {
        $app = Application::getInstance();
        $appVersion = $app::VERSION;
        if ($appVersion < 5) {
            return ManifestBeforeVite::class;
        }
        return null;
    }
}
