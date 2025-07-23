<?php

namespace Database\Factories;
use App\Models\Department;
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
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'phone' => $this->faker->optional()->numerify('011########'),
        'position' => $this->faker->jobTitle,
        'salary' => $this->faker->randomFloat(2, 3000, 15000),
        'hired_at' => $this->faker->date(),
        'status' => $this->faker->randomElement(['active', 'inactive']),
        'department_id' => Department::inRandomOrder()->first()->id,
        'created_at' => now(),
        'updated_at' => now(),
    ];
    }
}