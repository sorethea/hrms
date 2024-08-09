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
            //->hasConfigFile()
            ->hasMigrations()
            ->hasViews('vehicle')
            ->hasTranslations();
    }

    public function register(): void
    {
//        if (! app()->configurationIsCached()) {
//            $this->mergeConfigFrom(__DIR__.'/../config/restaurant.php', 'restaurant');
//        }

//        $this->loadTranslationsFrom(__DIR__.'/../lang','restaurant');
//        $this->loadViewsFrom(__DIR__.'/../resources/views','ev');
    }

    public function boot(): void
    {
        //$this->loadViewsFrom(__DIR__.'/../resources/views','ev');
    }
}
