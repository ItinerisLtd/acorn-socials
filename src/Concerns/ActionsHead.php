<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Concerns;

use Itineris\AcornSocials\Facades\AcornSocials;

trait ActionsHead
{
    public function actionPrintClipboardPageLink(): void
    {
        if (!AcornSocials::hasSocial('copy_to_clipboard')) {
            return;
        }
        echo '<div class="hidden" id="clipboard-page-link">' . esc_url(get_permalink()) . '</div>' . PHP_EOL;
    }
}
