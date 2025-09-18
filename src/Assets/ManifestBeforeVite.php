<?php

declare(strict_types=1);

namespace Itineris\AcornSocials\Assets;

use Roots\Acorn\Assets\Exceptions\ManifestNotFoundException;
use Roots\Acorn\Assets\Manifest;

class ManifestBeforeVite extends Manifest
{
    /** Extend manifest constructor to resolve vite manifest properly */
    public function __construct(array $config)
    {
        $this->path = $config['path'];
        $this->uri = $config['url'];
        $this->bundles =  isset($config['bundles']) ? $this->getJsonManifest($config['bundles']) : [];

        $assets = isset($config['assets']) ? $this->getJsonManifest($config['assets']) : [];
        foreach ($assets as $original => $revved) {
            if (is_array($revved)) {
                $revved = $revved['file'];
            }

            $this->assets[$this->normalizeRelativePath($original)] = $this->normalizeRelativePath($revved);
        }
    }

    protected function getJsonManifest(string $jsonManifest): array
    {
        if (! file_exists($jsonManifest)) {
            throw new ManifestNotFoundException("The asset manifest [{$jsonManifest}] cannot be found.");
        }

        //phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, Generic.PHP.ForbiddenFunctions.Found
        return json_decode(file_get_contents($jsonManifest), true) ?? [];
    }
}
