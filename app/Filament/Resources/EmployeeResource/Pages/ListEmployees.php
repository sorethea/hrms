<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

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
             null =>Tab::make("Active")->query(fn($query)=>$query->where("active",true)),
             "Male"=>Tab::make()->query(fn($query)=>$query->where("active",true)->where("gender","male")),
             "Female"=>Tab::make()->query(fn($query)=>$query->where("active",true)->where("gender","female")),
             "Inactive"=>Tab::make()->query(fn($query)=>$query->where("active",false)),
             "Probation"=>Tab::make()->query(fn($query)=>$query->where("active",true)->whereBetween(DB::raw('DATE(hired_date)'),[now()->subMonth(3),now()])),
         ];
     }
}
