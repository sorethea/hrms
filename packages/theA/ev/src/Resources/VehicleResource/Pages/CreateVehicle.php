<?php

namespace Sorethea\Ev\Resources\VehicleResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Sorethea\Ev\Resources\VehicleResource;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
