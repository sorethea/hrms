<?php

namespace App\Traits;

use Carbon\Carbon;

trait LeaveTrait
{
    function addWorkingDays($startDate, $workingDays, $holidays = []) {
        $currentDate = Carbon::make($startDate)->copy();
        $addedDays = 0;

        while ($addedDays < $workingDays) {
            $currentDate->addDay();
            if ($currentDate->isWeekday() && !in_array($currentDate->format('Y-m-d'), $holidays)) {
                $addedDays++;
            }
        }

        return $currentDate;
    }

    function workingDays($startDate, $endDate, $holidays = [])
    {
        return Carbon::make($startDate)->diffInDaysFiltered(function (Carbon $date) use ($holidays){
            return $date->isWeekend() || in_array($date->format('Y-m-d'),$holidays);
        },Carbon::make($endDate));

    }
}
