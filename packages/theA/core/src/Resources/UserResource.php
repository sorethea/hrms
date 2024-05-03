<?php

namespace Sorethea\Core\Resources;

use App\Models\User;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = User::class;

    public static function getNavigationIcon(): string
    {
        return config("the-a-core.icons.users");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('name')
                        ->label(trans('hr.name'))
                        ->unique('users','name',fn($record)=>$record)
                        ->required(),
                    Forms\Components\FileUpload::make('avatar_url')
                        ->label(trans('hr.avatar'))
                        ->directory('profile-photos')
                        ->disk('public')
                        ->avatar(),
                    Forms\Components\TextInput::make('email')
                        ->label(trans('hr.email'))
                        ->email()
                        ->unique('users', 'email',fn($record)=>$record)
                        ->nullable(),
                    Forms\Components\TextInput::make('phone_number')
                        ->label(trans('hr.phone_number'))
                        ->unique('users', 'phone_number',fn($record)=>$record)
                        ->nullable(),
                    Forms\Components\TextInput::make('password')
                        ->label(trans('hr.password'))
                        ->same('password_confirmation')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn($state)=>Hash::make($state))
                        ->dehydrated(fn($state)=>filled($state))
                        ->required(fn($record)=>!$record),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->label(trans('hr.password_confirmation'))
                        ->revealable()
                        ->password()
                        ->required(fn($record)=>!$record),

                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label(trans('hr.avatar'))
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('hr.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(trans('hr.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(trans('hr.phone_number'))
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('activities')
                    ->url(fn($record)=>self::getUrl('activities',['record'=>$record]))
                    ->icon('heroicon-o-bolt'),
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
            'index' => UserResource\Pages\ListUsers::route('/'),
            'create' => UserResource\Pages\CreateUser::route('/create'),
            'activities'=>UserResource\Pages\ListUserActivities::route('/{record}/activities'),
            'edit' => UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
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

    public static function getNavigationGroup(): ?string
    {
        return Utils::isResourceNavigationGroupEnabled()
            ? __('filament-shield::filament-shield.nav.group')
            : '';
    }
}
