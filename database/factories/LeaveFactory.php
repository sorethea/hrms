<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Holiday;
use App\Models\HolidayDate;
use App\Traits\LeaveTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Sodium\add;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    use LeaveTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qty = random_int(0,4);
        $employeeId = fake()->randomElement(Employee::query()
            ->where("leave_balance",">=",$qty)
            ->where("active",true)
            ->pluck("id")->toArray());
        //$employee = Employee::query()->find($employeeId);
        $publicHolidays = Holiday::query()
            ->whereYear("date",now()->year)
            ->pluck("date")
            ->toArray();
        $workingDates =[];
        $currentDate = Carbon::make(now()->startOfYear());
        $today = Carbon::make(now());
        while ($currentDate <= $today){
            if($currentDate->isWeekday() && !in_array($currentDate->format('Y-m-d'),$publicHolidays)) {
                $workingDates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay();
        }
        $from = fake()->randomElement($workingDates);
        $to = $this->addWorkingDays($from,$qty-1,$publicHolidays);
        //$status = fake()->randomElement(array_keys(config("hr.leave.status")));
//        if($status!="rejected"){
//            $employee->update(["leave_balance"=>$leaveBalance-$qty]);
//        }
        return [
            "employee_id"=>$employeeId,
            "from" =>$from,
            "to"=>$to,
            "remark"=>fake()->realTextBetween(20,50),
            //"status"=>$status,
            "type"=>fake()->randomElement(array_keys(config("hr.leave.type"))),
            //"balance"=>$employee->leave_balance??0,
            "qty"=>$qty,
        ];
    }
}
