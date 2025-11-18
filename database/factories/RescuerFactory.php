<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rescuer>
 */
class RescuerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shelterNames = [
            'Happy Paws Animal Shelter',
            'Second Chance Rescue',
            'Fluffy Friends Foundation',
            'Animal Haven Rescue',
            'Paws & Claws Sanctuary',
            'Pet Rescue Center',
            'Lovely Animal Shelter',
            'Safe Haven Pet Rescue',
        ];

        return [
            'shelter_name' => fake()->randomElement($shelterNames),
            'shelter_address' => fake()->address(),
            'description' => fake()->paragraph(3),
            'is_verified' => fake()->boolean(70), // 70% verified
        ];
    }

    /**
     * Indicate that the rescuer is verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => true,
        ]);
    }

    /**
     * Indicate that the rescuer is not verified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_verified' => false,
        ]);
    }
}
