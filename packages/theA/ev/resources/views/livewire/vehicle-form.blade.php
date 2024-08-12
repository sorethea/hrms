<x-filament::card>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{$this->form}}
        <div class="text-right">
            <x-filament::button type="submit" form="submit" class="align-right">
                {{ __('ev::default.vehicle.save') }}
            </x-filament::button>
        </div>
    </form>
</x-filament::card>
