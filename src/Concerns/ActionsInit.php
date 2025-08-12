<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Concerns;

use Itineris\AcornSocials\Integrations\Customizer;

trait ActionsInit
{
    public function actionIntegrateCustomizer(): void
    {
        Customizer::register();
    }
}
