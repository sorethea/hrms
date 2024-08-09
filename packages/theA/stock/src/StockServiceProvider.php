<?php

namespace Sorethea\Stock;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class StockServiceProvider extends PackageServiceProvider
{
    public static string $name = "thea-stock";
    public function register(): void
    {

    }

    public function boot(): void
    {
    }

    public function configurePackage(Package $package): void
    {
        $package->name('thea-stock')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasMigrations()
            ->hasViews();
    }
}
