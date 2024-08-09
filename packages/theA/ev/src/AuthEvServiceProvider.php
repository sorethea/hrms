<?php

namespace Sorethea\Ev;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sorethea\Ev\Models\Vehicle;
use Sorethea\Ev\Policies\VehiclePolicy;

class AuthEvServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vehicle::class => VehiclePolicy::class,
    ];
    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}
