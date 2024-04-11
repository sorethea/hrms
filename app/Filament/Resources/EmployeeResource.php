<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Filament\Resources\EmployeeResource\Widgets\EmployeeStat;
use App\Models\Employee;
use Carbon\Carbon;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make("name")
                        ->label("Latin Name")
                        ->required(),
                    Forms\Components\TextInput::make("name_kh")
                        ->label("Khmer Name")
                        ->required(),
                    Forms\Components\Select::make("gender")
                        ->options(["male"=>"Male","female"=>"Female"])
                        ->required(),
                    Forms\Components\DatePicker::make("date_of_birth")->required(),
                    Forms\Components\DatePicker::make("hired_date")->required(),
                    Forms\Components\Toggle::make("active")->default(true),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("code")->searchable(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("position")->searchable(),
                Tables\Columns\TextColumn::make("gender")
                    ->searchable()
                    ->formatStateUsing(fn($state)=>ucfirst($state)),
                Tables\Columns\IconColumn::make("probation")
                    ->false('')
                    ->boolean(),
                Tables\Columns\TextColumn::make("date_of_birth")
                    ->label("Age")
                    ->formatStateUsing(fn($state)=>Carbon::make($state)->age)
                    ->suffix("year(s)"),
                Tables\Columns\IconColumn::make("active")
                    ->boolean(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('hr.human_resources');
    }

    public static function getWidgets(): array
    {
        return [
            EmployeeStat::class,
        ];
    }
}
