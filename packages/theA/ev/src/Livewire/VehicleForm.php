<?php

namespace Sorethea\Ev\Livewire;

use Filament\Forms\Form;
use Livewire\Component;

class VehicleForm extends Component
{
    public function form(Form $form): Form {
        return $form->schema([

        ]);
    }
    public function submit(): void {

    }
    public function render()
    {
        return view('vehicle::livewire.vehicle-form');
    }
}
