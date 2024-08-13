<?php

namespace Sorethea\Ev\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Sorethea\Ev\Models\Vehicle;

class VehicleForm extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    protected string $view = 'ev::livewire.vehicle-form';

    public ? array $data = [];
    public ? array $vehicle = [];
    public function mount(){
        $user = auth()->user();
        $this->vehicle = Vehicle::where('user_id',$user->id)->first()->toArray()??[];
    }
    public function form(Form $form): Form {
        dd($this->vehicle);
        return $form->schema([
            Section::make([
                TextInput::make('make')
                    ->label(__('ev::default.vehicle.make'))
                    ->required(),
                TextInput::make('model')
                    ->label(__('ev::default.vehicle.model'))
                    ->required(),
                TextInput::make('year')
                    ->label(__('ev::default.vehicle.year'))
                    ->required(),
                TextInput::make('odo')
                    ->label(__('ev::default.vehicle.odo'))
                    ->nullable(),
                DatePicker::make('buying_date')
                    ->label(__('ev::default.vehicle.buying_date'))
                    ->nullable(),
                TextInput::make('cost')
                    ->label(__('ev::default.vehicle.cost'))
                    ->nullable(),
                TextInput::make('battery_type')
                    ->label(__('ev::default.vehicle.battery_type'))
                    ->nullable(),
                TextInput::make('battery_capacity')
                    ->label(__('ev::default.vehicle.battery_capacity'))
                    ->nullable(),
                TextInput::make('plate')
                    ->label(__('ev::default.vehicle.plate'))
                    ->nullable(),
                FileUpload::make('images')
                    ->multiple()
                    ->nullable()
                    ->image(),
            ])->columns(2),

        ])->fill($this->vehicle)
            ->statePath('data');
    }
    public function submit(): void {

        $data = collect($this->form->getState())->all();
        $data['user_id']=auth()->user()->id??null;
        Vehicle::updateOrCreate($data);
        Notification::make()
            ->success()
            ->title(__('ev::default.vehicle.notify'))
            ->send();
    }

    public function render(): string
    {
        return $this->view;
    }
}
