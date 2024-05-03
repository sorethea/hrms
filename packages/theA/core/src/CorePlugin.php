<?php

namespace Sorethea\Core;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Contracts\Plugin;
use Filament\Forms\Components\FileUpload;
use Filament\Panel;
use Jeffgreco13\FilamentBreezy\BreezyCore;
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
        $panel->plugins([
            FilamentShieldPlugin::make(),
            BreezyCore::make()
                ->myProfile(
                    hasAvatars: true,
                )
                ->avatarUploadComponent(fn() => FileUpload::make('avatar_url')
                    ->avatar()
                    ->directory('profile-photos')
                    ->disk('public')),
        ])->resources([
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
