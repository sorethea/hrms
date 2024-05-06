<?php

namespace Sorethea\Core;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sorethea\Core\Models\User;
use Sorethea\Core\Policies\RolePolicy;
use Sorethea\Core\Policies\UserPolicy;
use Spatie\Permission\Models\Role;

class AuthCoreServiceProvider extends ServiceProvider
{

    protected $policies = [
        Role::class=>RolePolicy::class,
        User::class=>UserPolicy::class,
    ];
    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}
