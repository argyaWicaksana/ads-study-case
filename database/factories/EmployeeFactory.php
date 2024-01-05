<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_number' => fake()->unique()->numerify('IP06###'),
            'name' => fake()->name(),
            'address' => fake()->address(),
            'birthday' => fake()->date(),
            'join_date' => fake()->date(),
        ];
    }
}
