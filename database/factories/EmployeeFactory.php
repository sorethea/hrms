<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

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
        $this->i += 1;
        return [
            "code"=>'TH-'.str_pad($this->i,4,"0",0),
            "name"=>fake()->name,
            "position"=>fake()->jobTitle(),
            "gender"=>fake()->randomElement(["male","female"]),
            "date_of_birth"=>fake()->dateTimeBetween('-50 years','-25 years'),
            "hired_date"=>fake()->dateTimeBetween('-10 years'),
            "active"=>fake()->randomElement([true,false]),
        ];
    }
}
