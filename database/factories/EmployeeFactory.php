<?php

namespace Database\Factories;

use App\Models\Employee;
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
        return [
            "code"=>'THF'.str_pad(fake()->unique()->numberBetween(1,1000),6,"0",0),
            "name"=>fake()->name,
            "position"=>fake()->jobTitle(),
            "gender"=>fake()->randomElement(["male","female"]),
            "date_of_birth"=>fake()->dateTimeBetween('-50 years','-20 years'),
            "hired_date"=>fake()->dateTimeBetween('-10 years',now()),
            "active"=>fake()->randomElement([true,false]),
        ];
    }
}
