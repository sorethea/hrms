<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Helpers\LeaveHelper;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Transaction;
use App\Observers\LeaveObserver;
use App\Traits\LeaveTrait;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //use LeaveTrait;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $jobTitle = fake()->jobTitle();

        Employee::factory(1000)->create()->each(function($employee){
            if($employee->active && str_contains($employee->position,"Manager")){
                Employee::factory(random_int(3,10))->create(["report_to"=>$employee->id]);
            }
        });

        $this->call([
            Holiday2024::class
        ]);

        Leave::factory(1000)->create()->each(function (Leave $leave){
            $balance = $leave->employee->leave_balance ?? 0;
            if($balance >= $leave->qty){

                $i = fake()->randomElement([1,2,3,4,5,6]);
                if(in_array($i,[1,2,3,4,5])){
                    LeaveHelper::approve($leave);
                    $j = fake()->randomElement([1,2,3,4,5,6]);
                    if($j == 6)
                    LeaveHelper::reject($leave);
                }
            }else{
                LeaveHelper::cancel($leave);
            }

        });
    }
}
