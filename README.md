# Acorn Socials Package

This repo can be used to scaffold an Acorn package. See the [Acorn Package Development](https://roots.io/acorn/docs/package-development/) docs for further information.

## Installation

You can install this package with Composer:

```bash
composer require itinerisltd/acorn-socialse
```

You can publish the config file with:

```shell
$ wp acorn vendor:publish --provider="Itineris\AcornSocials\Providers\AcornSocialsServiceProvider"
```

## Usage

From a Blade template:

```blade
@include('AcornSocials::example')
```

From WP-CLI:

```shell
$ wp acorn acorn-socials
```
