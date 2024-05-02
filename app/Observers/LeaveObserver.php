<?php

namespace App\Observers;

use App\Models\Leave;
use App\Models\Transaction;

class LeaveObserver
{
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        $leave->status = "pending";
        $leave->save();
    }

    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {

    }

    /**
     * Handle the Leave "deleted" event.
     */
    public function deleted(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "restored" event.
     */
    public function restored(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "force deleted" event.
     */
    public function forceDeleted(Leave $leave): void
    {
        //
    }

}
