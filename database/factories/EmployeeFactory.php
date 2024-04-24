<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\OrganizationalUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;
use function Symfony\Component\Translation\t;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public $i = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hiredDate = fake()->dateTimeBetween('-10 years',now());
//        $leaveBalance = $hiredDate <= now()->startOfYear()?18:round(Carbon::make($hiredDate)
//                ->diffInMonths(Carbon::make(now()->endOfYear())),0)*1.5;
        $isActive = fake()->randomElement([true,false]);
        $isProbation = Carbon::make($hiredDate)->between(now()->subMonth(3),now());
        $leaveBalance = !$isProbation && $isActive ? 18:0;
        $ous = OrganizationalUnit::query()->where("active",true)->pluck("id");
        return [
            "code"=>'THF'.str_pad(fake()->unique()->numberBetween(1,1000),6,"0",0),
            "name"=>fake()->name,
            "position"=>fake()->jobTitle(),
            "gender"=>fake()->randomElement(["male","female"]),
            "date_of_birth"=>fake()->dateTimeBetween('-50 years','-20 years'),
            "ou_id"=>fake()->randomElement($ous),
            "hired_date"=>$hiredDate,
            "leave_balance"=>$leaveBalance,
            "active"=>$isActive,
        ];
    }
}
