<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date_in" => fake()->date(),
            "vehicle_id" => fake()->numberBetween(1, 500),
            "short_description" => fake()->word(),
            "long_description" => fake()->word(),
            "main_image" => fake()->word(),
            "images" => fake()->word(),
            "user_id" => 1
        ];
    }
}
