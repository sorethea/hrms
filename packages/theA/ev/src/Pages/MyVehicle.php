<?php

namespace Sorethea\Ev\Pages;

use Filament\Pages\Page;

class MyVehicle extends Page
{
    protected static ?string $navigationIcon = 'bi-ev-front';

    protected static string $view = 'vehicle::filament.pages.my-vehicle';
}