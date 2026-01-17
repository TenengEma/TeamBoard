<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $departments = ['HR', 'IT', 'Sales', 'Finance', 'Marketing'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'department' => fake()->randomElement($departments),
            'phone_number' => fake()->phoneNumber(),
            'biographical_information' => fake()->paragraph(),
        ];
    }
}
