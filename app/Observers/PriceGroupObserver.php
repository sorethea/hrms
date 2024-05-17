<?php

namespace App\Observers;

use Sorethea\Restaurant\Models\PriceGroup;

class PriceGroupObserver
{
    /**
     * Handle the PriceGroup "created" event.
     */
    public function created(PriceGroup $priceGroup): void
    {
        if($priceGroup->is_default) PriceGroup::query()->where("id","<>",$priceGroup->id)->update(["is_default"=>false]);
    }

    /**
     * Handle the PriceGroup "updated" event.
     */
    public function updated(PriceGroup $priceGroup): void
    {
        if($priceGroup->is_default) PriceGroup::query()->where("id","<>",$priceGroup->id)->update(["is_default"=>false]);
    }

    /**
     * Handle the PriceGroup "deleted" event.
     */
    public function deleted(PriceGroup $priceGroup): void
    {
        //
    }

    /**
     * Handle the PriceGroup "restored" event.
     */
    public function restored(PriceGroup $priceGroup): void
    {
        //
    }

    /**
     * Handle the PriceGroup "force deleted" event.
     */
    public function forceDeleted(PriceGroup $priceGroup): void
    {
        //
    }
}
