<?php

namespace App\Filament\Resources\LeaveResource\Pages;

use App\Filament\Resources\LeaveResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListLeaves extends ListRecords
{
    protected static string $resource = LeaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null =>Tab::make("All"),
            "Pending"=>Tab::make()->query(fn($query)=>$query->where("status","pending")),
            "Approved"=>Tab::make()->query(fn($query)=>$query->where("status","approved")),
            "Rejected"=>Tab::make()->query(fn($query)=>$query->where("status","rejected")),
            "Cancelled"=>Tab::make()->query(fn($query)=>$query->where("status","cancelled")),
        ];
    }
}
