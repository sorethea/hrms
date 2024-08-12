<?php

namespace Sorethea\Ev\Resources;

use Sorethea\Ev\Resources\VehicleResource\Pages;
use Sorethea\Ev\Resources\VehicleResource\RelationManagers;
use Sorethea\Ev\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'carbon-traffic-event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Ev\Resources\VehicleResource\Pages\ListVehicles::route('/'),
            'create' => \Sorethea\Ev\Resources\VehicleResource\Pages\CreateVehicle::route('/create'),
            'edit' => \Sorethea\Ev\Resources\VehicleResource\Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
