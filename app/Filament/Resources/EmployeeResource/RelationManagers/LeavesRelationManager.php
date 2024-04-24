<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use App\Models\Holiday;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeavesRelationManager extends RelationManager
{
    protected static string $relationship = 'Leaves';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('from')
                    ->reactive()
                    ->required(),
                Forms\Components\DatePicker::make('to')
                    ->reactive()
                    ->live()
                    ->minDate(fn(Forms\Get $get)=>$get("from"))
                    ->afterStateUpdated(function($state, Forms\Get $get, callable $set){
                        $holidays = Holiday::query()->whereYear("date",Carbon::make(now())->year)->pluck("date")->toArray();
                        $from = $get("from");
                        $qty = 0;
                        $currentDate = Carbon::make($from);
                        $endDate = Carbon::make($state);
                        while ($currentDate <= $endDate){
                            if($currentDate->isWeekday() && !in_array($currentDate->format('Y-m-d'),$holidays)){
                                $qty ++;
                            }
                            $currentDate->addDay();
                        }
                        //dd($qty);
                        $set("qty",$qty);
                    })
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options(fn()=>config("hr.leave.type"))
                    ->default("annual_leave"),
                Forms\Components\Select::make('status')
                    ->options(fn()=>config("hr.leave.status"))
                    ->default("approved"),
                Forms\Components\TextInput::make('qty')
                    ->helperText("Number of leave taken in day")
                    ->numeric(),
                Forms\Components\TextInput::make('reason')
                    ->maxLength(255)
                    ->columnSpan(2)
            ]);
    }
    protected function applyDefaultSortingToTableQuery(Builder $query): Builder
    {
        return $query->orderBy("from","desc");
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('from,to,qty')
            ->columns([
                Tables\Columns\TextColumn::make('from')
                    ->date(),
                Tables\Columns\TextColumn::make('to')->date(),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state)=>config("hr.leave.status.".$state))
                    ->color(fn(string $state): string => match ($state){
                        "pending"=>"info",
                        "approved"=>"success",
                        "rejected"=>"danger",
                    }),
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
