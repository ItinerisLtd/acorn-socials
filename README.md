# Acorn Socials Package

## About

Social account and sharable social links management via customizer.

## Installation

You can install this package with Composer:

```bash
composer require itinerisltd/acorn-socials
```

You can publish the config file with:

```shell
$ wp acorn vendor:publish --provider="Itineris\AcornSocials\Providers\AcornSocialsServiceProvider"
```

## Excluding/Including Socials

Edit `config/acorn-socials.php` to exclude/include Socials

```diff
<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Socials
    |--------------------------------------------------------------------------
    |
    | Here, you can define which socials will be used only
    |
    */
-   'socials' => [],
+   'socials' => [
+    'facebook' => [
+       'social' => true/false,  // Controls accessibility on AcornSocials::getSocialPages()
+       'sharable' => true/false, // Controls accessibility on AcornSocials::getSharableSocials()
+     ],
+     'email' => [], // Empty array will make accessible on both
+   ],

];
```
