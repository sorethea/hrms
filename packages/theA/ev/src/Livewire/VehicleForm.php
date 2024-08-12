<?php

namespace Sorethea\Ev\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class VehicleForm extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    protected string $view = 'vehicle::livewire.vehicle-form';

    public function form(Form $form): Form {
        return $form->schema([

        ])->statePath('data');
    }
    public function submit(): void {

    }
}
