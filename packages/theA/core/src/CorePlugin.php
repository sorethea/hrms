<?php

namespace Sorethea\Core;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Sorethea\Core\Resources\RoleResource;
use Sorethea\Core\Resources\UserResource;

class CorePlugin implements Plugin
{

    public function getId(): string
    {
        return "the-a-core";
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            UserResource::class,
            RoleResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {

    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
