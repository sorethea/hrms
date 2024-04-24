<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Filament\Resources\LeaveResource\RelationManagers;
use App\Models\Holiday;
use App\Models\Leave;
use App\Traits\LeaveTrait;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveResource extends Resource
{
    protected static ?string $model = Leave::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\Select::make('employee_id')
                        ->relationship('employee', 'name')
                        ->searchable()
                        ->required(),
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
//                    Forms\Components\Select::make('status')
//                        ->options(fn()=>config("hr.leave.status"))
//                        ->hiddenOn('create')
//                        ->default("approved"),
                    Forms\Components\TextInput::make('qty')
                        ->helperText("Number of leave taken in day")
                        ->numeric(),
                    Forms\Components\Textarea::make('remark')
                        ->maxLength(255)
                        ->columnSpan(2)
                        ->default(null),
                ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('from')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn($state)=>config("hr.leave.type.".$state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('remark')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn($state)=>config("hr.leave.status.".$state))
                    ->badge()
                    ->color(fn(string $state): string => match ($state){
                        "pending"=>"info",
                        "approved"=>"success",
                        "rejected"=>"danger",
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->suffix(fn($record)=>$record->qty == 1?"day":"days")
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->numeric(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('hr.human_resources');
    }
}
