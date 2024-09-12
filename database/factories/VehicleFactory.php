<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "plate" => fake()->word() . fake()->randomNumber(4, true),
            "engine_serial" => fake()->randomNumber(9, true) . fake()->randomNumber(9, true),
            "serial_number" => fake()->randomNumber(9, true) . fake()->randomNumber(6, true),
            "color" => fake()->word(),
            "vehicle_model_id" => fake()->numberBetween(1, 6),
            "owner_id" => fake()->numberBetween(1, 3),
            "user_id" => 1
        ];
    }
}
