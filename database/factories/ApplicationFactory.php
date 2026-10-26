<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company' => fake()->company(),
            'role' => fake()->jobTitle(),
            'status' => fake()->randomElement(ApplicationStatus::cases()),
            'applied_date' => fake()->dateTimeBetween('-3 months')->format('Y-m-d'),
            'salary_range' => 'RM'.fake()->numberBetween(3, 8).'000',
            'notes' => fake()->sentence(),
        ];

    }
}
