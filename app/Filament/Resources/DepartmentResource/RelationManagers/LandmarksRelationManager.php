<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandmarksRelationManager extends RelationManager
{
    protected static string $relationship = 'landmarks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->unique("landmarks","code",fn($record)=>$record)
                    ->maxLength(35),
                Forms\Components\TextInput::make("name")
                    ->maxLength(120)
                    ->nullable(),
                Forms\Components\TagsInput::make("contact_number")
                    ->placeholder("New contact number")
                    ->helperText("Add new contact number with comma (,).")
                    ->nestedRecursiveRules([
                        'digits_between:9,10'
                    ])
                    ->columnSpan(2)
                    ->splitKeys([","]),
                Forms\Components\Textarea::make("address")
                    ->autosize()
                    ->columnSpan(2),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('code')->searchable(),
                Tables\Columns\TextColumn::make('contact_number')->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
