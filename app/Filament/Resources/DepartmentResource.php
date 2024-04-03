<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make("name")
                        ->unique('departments','name',fn($record)=>$record)
                        ->required(),
                    Forms\Components\Select::make("parent")
                        ->relationship('parent','name')
                        ->searchable()
                        ->nullable(),
                    Forms\Components\Toggle::make("is_brand")
                        ->live()
                        ->default(false),
                    Forms\Components\FileUpload::make("logo")
                        ->image()
                        ->hidden(fn(Get $get):bool =>!$get('is_brand'))
                        ->nullable(),
                    Forms\Components\Textarea::make("description")
                        ->columnSpan(2)
                        ->nullable(),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->circular(),
                Tables\Columns\TextColumn::make("name")
                    ->searchable(),
                Tables\Columns\TextColumn::make("parent.name")
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_brand')
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }


    public static function getNavigationGroup(): ?string
    {
        return trans('hr.human_resources');
    }
}
