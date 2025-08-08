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
        $useCustomizer = config('acorn-socials.settings.use_customizer') && Customizer::shouldRegister();
        if ($useCustomizer) {
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
        if (method_exists($this, $hookName)) {
            return [$this, $hookName];
        }
        return [$this, $hookType . Str::studly($hookName)];
    }
}
