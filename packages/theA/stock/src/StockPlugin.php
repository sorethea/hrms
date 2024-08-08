<?php

namespace Sorethea\Stock;

use Filament\Panel;

class StockPlugin implements \Filament\Contracts\Plugin
{

    public function getId(): string
    {
        return 'theA-stock';
    }

    public function register(Panel $panel): void
    {

    }

    public function boot(Panel $panel): void
    {

    }

    public function make(): static{
        return app(static::class);
    }
}
