<?php

namespace Sorethea\Ev;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Sorethea\Ev\Pages\MyEv;
use Sorethea\Ev\Pages\MyVehicle;
use Sorethea\Ev\Resources\VehicleResource;

class EvPlugin implements Plugin
{
    public function getId(): string
    {
        return 'thea-ev';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                MyVehicle::class,
            ])
            ->resources([
            VehicleResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {

    }

    public static function make(): static
    {
        return app(static::class);
    }
}
