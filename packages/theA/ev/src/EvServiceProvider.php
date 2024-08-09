<?php

namespace Sorethea\Ev;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EvServiceProvider extends PackageServiceProvider
{
    public static string $name = "thea-ev";

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile('vehicle')
            ->hasMigrations()
            ->hasViews('vehicle')
            ->hasTranslations();
    }

}
