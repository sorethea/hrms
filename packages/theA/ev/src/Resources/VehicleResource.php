<?php

namespace Sorethea\Ev\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use OpenSpout\Reader\SheetInterface;
use Sorethea\Ev\Models\Vehicle;

class VehicleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $slug = 'vehicles';

    protected static ?string $navigationIcon = 'bi-carbon-traffic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Ev\Resources\VehicleResource\Pages\ListVehicles::route('/'),
            'create' => \Sorethea\Ev\Resources\VehicleResource\Pages\CreateVehicle::route('/create'),
            'edit' => \Sorethea\Ev\Resources\VehicleResource\Pages\EditVehicle::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
}
