<?php

namespace Sorethea\Ev;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EvServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package->name('thea-ev')
            ->hasConfigFile()
            ->hasMigrations()
            ->hasViews()
            ->hasTranslations();
    }

    public function register(): void
    {

    }

    public function boot(): void
    {

    }
}
