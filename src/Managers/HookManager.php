<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Managers;

use Illuminate\Support\Str;
use Itineris\AcornSocials\Concerns\ActionsInit;
use Itineris\AcornSocials\Integrations\Customizer;

class HookManager
{
    use ActionsInit;

    public function registerHooks(): void
    {
        $this->bootWpActions();
    }

    public function bootWpActions(): void
    {
        if (Customizer::shouldRegister()) {
            add_action('init', $this->action('integrate_customizer'));
        }
    }

    public function action(string $action): array
    {
        return $this->hook('action', $action);
    }

    public function filter(string $filter): array
    {
        return $this->hook('filter', $filter);
    }

    private function hook(string $hookType, string $hookName): array
    {
        return method_exists($this, $hookName)
            ? [$this, $hookName]
            : [$this, $hookType . Str::studly($hookName)];
    }
}
