<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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

        Employee::factory(100)->create()->each(function($employee){
            if($employee->active && str_contains($employee->position,"Manager")){
                Employee::factory(random_int(3,10))->create(["report_to"=>$employee->id]);
            }
        });

        $this->call([
            Holiday2024::class
        ]);

        Leave::factory(200)->create();

    }
}
