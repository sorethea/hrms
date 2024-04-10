<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListEmployees extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return EmployeeResource::getWidgets();
    }

     public function getTabs(): array
     {
         return [
             null =>Tab::make("All"),
             "Male"=>Tab::make()->query(fn($query)=>$query->where("gender","male")),
             "Female"=>Tab::make()->query(fn($query)=>$query->where("gender","female")),
             "Active"=>Tab::make()->query(fn($query)=>$query->where("active",true)),
             "Inactive"=>Tab::make()->query(fn($query)=>$query->where("active",false)),
         ];
     }
}
