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
        $balance = $leave->employee->leave_balance??0;
        $lastBalance = $balance - $leave->qty;
        Transaction::create([
            "reference_id"=>$leave->id,
            "reference_type"=>get_class($leave),
            "balance"=>$balance,
            "last_balance"=>$lastBalance,
            "qty"=>$leave->qty,
            "type"=>"Leave Request",
            "remark"=>"Created"
        ]);
        $leave->status = "pending";
        $leave->save();
        $leave->employee->leave_balance = $lastBalance;
        $leave->employee->save();
    }

    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {
        //
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
