<?php

namespace Sorethea\Hrms\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Sorethea\Hrms\Models\Employee;
use Sorethea\Hrms\Resources\EmployeeResource\Widgets\EmployeeStat;

class EmployeeResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->tabs([
                    Forms\Components\Tabs\Tab::make("Personal Data")
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Forms\Components\TextInput::make("name")
                            ->label("Latin Name")
                            ->required(),
                            Forms\Components\TextInput::make("name_kh")
                                ->label("Khmer Name")
                                ->required(),
                            Forms\Components\TextInput::make("leave_balance")
                                ->visibleOn("view")
                                ->readOnly(),
                            Forms\Components\Select::make("gender")
                                ->options(["male"=>"Male","female"=>"Female"])
                                ->required(),
                            Forms\Components\DatePicker::make("date_of_birth")->required(),
                            Forms\Components\TextInput::make("position")->required(),
                            Forms\Components\Checkbox::make("system_user")
                                ->reactive()
                                ->default(false),
                            Forms\Components\TextInput::make("email")
                                ->required(fn(Get $get):bool=>$get('system_user')),
                            Forms\Components\TextInput::make("phone_number")
                                ->required(fn(Get $get):bool=>$get('system_user')),
//                            Forms\Components\Select::make("user")
//                                ->searchable()
//                                ->relationship("user","name")
//                                ->visible(fn(Get $get):bool=>$get('system_user'))
//                                ->createOptionForm([
//
//                                ])
//                                ->required(),
                            Forms\Components\Select::make("ou")
                                ->relationship('ou',"name")
                                ->label('Department')
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make("marital_status")
                                ->options(config("hrms.marital-status"))
                                ->searchable()
                                ->nullable(),
                            Forms\Components\DatePicker::make("hired_date")->required(),
                            Forms\Components\DatePicker::make("last_working_date")->nullable(),
                            Forms\Components\TextInput::make("probation_duration")
                                ->suffix('months')
                                ->nullable()
                                ->default(3),
                            Forms\Components\DatePicker::make("probation_confirmation_date")->nullable(),
                            Forms\Components\Select::make('report_to')
                                ->relationship('manager','name')
                                ->searchable()
                                ->nullable(),
                            Forms\Components\Toggle::make("active")->default(true),
                            Forms\Components\FileUpload::make("avatar_url")
                                ->label("Photo")
                                ->image()
                                ->nullable(),
                        ])->columns(3),
                    Forms\Components\Tabs\Tab::make("Compliance")
                        ->icon('heroicon-o-lock-closed')
                        ->schema([
                            Forms\Components\TextInput::make("id_card")
                                ->nullable(),
                            Forms\Components\TextInput::make("nssf_no")
                                ->nullable(),
                            Forms\Components\TextInput::make("bank_account_name")
                                ->nullable(),
                            Forms\Components\TextInput::make("bank_account_no")
                                ->nullable(),
                            Forms\Components\TextInput::make("basic_salary")
                                ->nullable(),
                        ])->columns(3),
                    Forms\Components\Tabs\Tab::make("Dependencies")
                        ->icon('heroicon-o-arrows-right-left')
                        ->schema([
                            Forms\Components\Repeater::make("dependencies")
                                ->schema([
                                    Forms\Components\TextInput::make("name")
                                        ->required(),
                                    Forms\Components\Select::make("gender")
                                        ->options(["male"=>"Male","female"=>"Female"])
                                        ->required(),
                                    Forms\Components\DatePicker::make("date_of_birth")->required(),
                                    Forms\Components\TextInput::make("relation")
                                        ->required(),
                                ])->columns(3),
                        ]),
                    Forms\Components\Tabs\Tab::make("Educations")
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Forms\Components\Repeater::make("educations")
                                ->schema([
                                    Forms\Components\TextInput::make("institution")
                                        ->required(),
                                    Forms\Components\Select::make("from")
                                        ->options(config("hrms.years"))
                                        ->prefix('Year')
                                        ->required(),
                                    Forms\Components\Select::make("to")
                                        ->options(config("hrms.years"))
                                        ->prefix('Year')
                                        ->required(),
                                ])->columns(3),
                        ]),
                    Forms\Components\Tabs\Tab::make("Skills")
                        ->icon('heroicon-o-light-bulb')
                        ->schema([
                            Forms\Components\Repeater::make("skills")
                                ->schema([
                                    Forms\Components\TextInput::make("skill")
                                        ->required(),
                                    Forms\Components\MarkdownEditor::make("description")
                                        ->columnSpan(3)
                                        ->required(),
                                ])->columns(3),
                        ]),
                    Forms\Components\Tabs\Tab::make("Work Experiences")
                        ->icon('heroicon-o-rectangle-group')
                        ->schema([
                            Forms\Components\Repeater::make("work_experiences")
                                ->schema([
                                    Forms\Components\TextInput::make("company_name")
                                        ->required(),
                                    Forms\Components\Select::make("from")
                                        ->options(config("hrms.years"))
                                        ->prefix('Year')
                                        ->required(),
                                    Forms\Components\Select::make("to")
                                        ->options(config("hrms.years"))
                                        ->prefix('Year')
                                        ->required(),
                                    Forms\Components\MarkdownEditor::make("experience")
                                        ->columnSpan(3)
                                        ->required(),
                                ])->columns(3),
                        ]),
                    Forms\Components\Tabs\Tab::make("Attached Files")
                        ->icon('heroicon-o-document')
                        ->schema([
                            Forms\Components\Repeater::make("attached_files")
                                ->schema([
                                    Forms\Components\TextInput::make("name")
                                        ->required(),
                                    Forms\Components\FileUpload::make("file")
                                        ->disk('public')
                                        ->directory("attached_files")
                                        ->visibility('public')
                                        ->downloadable()
                                        ->required(),
                                ])->columns(3),

                        ]),

                ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make("avatar_url")
                    ->label("Photo")
                    ->defaultImageUrl(fn($record)=>$record->getFilamentAvatarUrl())
                    ->circular(),
                Tables\Columns\TextColumn::make("code")->searchable(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("position")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make("gender")
                    ->searchable()
                    ->formatStateUsing(fn($state)=>ucfirst($state)),
//                Tables\Columns\IconColumn::make("probation")
//                    ->false('')
//                    ->boolean(),

                Tables\Columns\TextColumn::make("date_of_birth")
                    ->label("Age")
                    ->formatStateUsing(fn($state)=>Carbon::make($state)->age)
                    ->suffix("year(s)"),
                Tables\Columns\TextColumn::make("hired_date")
                    ->date(),
                Tables\Columns\TextColumn::make("leave_balance")
                    ->suffix("day(s)"),
                Tables\Columns\TextColumn::make("manager.name")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make("active")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('activities')
                        ->url(fn($record)=>self::getUrl('activities',['record'=>$record]))
                        ->icon('heroicon-o-bolt'),
                    Tables\Actions\EditAction::make(),
                ]),
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
            \Sorethea\Hrms\Resources\EmployeeResource\RelationManagers\LeavesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hrms\Resources\EmployeeResource\Pages\ListEmployees::route('/'),
            'create' => \Sorethea\Hrms\Resources\EmployeeResource\Pages\CreateEmployee::route('/create'),
            'view' => \Sorethea\Hrms\Resources\EmployeeResource\Pages\ViewEmployee::route('/{record}'),
            'activities' => \Sorethea\Hrms\Resources\EmployeeResource\Pages\ListEmployeeActivities::route('/{record}/activities'),
            'edit' => \Sorethea\Hrms\Resources\EmployeeResource\Pages\EditEmployee::route('/{record}/edit'),
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
