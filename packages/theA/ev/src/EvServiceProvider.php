<?php

namespace Sorethea\Ev;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EvServiceProvider extends PackageServiceProvider
{
    public static string $name = "ev";

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile('vehicle')
            ->hasMigrations(['create_vehicles_table'])
            ->hasViews()
            ->hasTranslations()
            ->hasInstallCommand(function (InstallCommand $command){
                $command->startWith(function (InstallCommand $command){
                    $command->info("Electric Vehicle Installation.");
                })
                ->publishConfigFile()
                ->publishMigrations()
                ->endWith(function (InstallCommand $command){
                    $command->info("Installation Completed!");
                });
            });
    }

}
