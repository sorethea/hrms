<?php

namespace App\Observers;

use App\Models\Food;

class FoodObserver
{
    /**
     * Handle the Food "created" event.
     */
    public function created(Food $food): void
    {
        //
    }

    /**
     * Handle the Food "updated" event.
     */
    public function updated(Food $food): void
    {
        //
    }

    /**
     * Handle the Food "deleted" event.
     */
    public function deleted(Food $food): void
    {
        //
    }

    /**
     * Handle the Food "restored" event.
     */
    public function restored(Food $food): void
    {
        //
    }

    /**
     * Handle the Food "force deleted" event.
     */
    public function forceDeleted(Food $food): void
    {
        //
    }
}
