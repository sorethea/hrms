<?php

namespace Sorethea\Ev\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class VehicleForm extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    protected string $view = 'ev::livewire.vehicle-form';

    public array $data = [];

    public function form(Form $form): Form {
        return $form->schema([
            Section::make([
                TextInput::make('make')
                    ->label(__('ev::default.vehicle.make'))
                    ->required(),
            ])->columns(2),

        ])->statePath('data');
    }
    public function submit(): void {

    }

    public function render(): string
    {
        return $this->view;
    }


}
