<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employees = Employee::all('id_number')->pluck('id_number')->toArray();
        return [
            'id_number' => fake()->unique()->randomElement($employees),
            'date' => fake()->date(),
            'duration' => fake()->numberBetween(1, 12),
            'description' => fake()->sentence(),
        ];
    }
}
