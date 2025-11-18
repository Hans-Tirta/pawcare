<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = fake()->randomElement(['dog', 'cat', 'bird', 'rabbit', 'other']);
        
        $dogNames = ['Max', 'Buddy', 'Charlie', 'Rocky', 'Luna', 'Bella', 'Daisy'];
        $catNames = ['Whiskers', 'Mittens', 'Shadow', 'Luna', 'Simba', 'Nala', 'Tiger'];
        $birdNames = ['Tweety', 'Chirpy', 'Sky', 'Sunny', 'Kiwi'];
        $rabbitNames = ['Thumper', 'Cottontail', 'Snowball', 'Fluffy'];

        $name = match($species) {
            'dog' => fake()->randomElement($dogNames),
            'cat' => fake()->randomElement($catNames),
            'bird' => fake()->randomElement($birdNames),
            'rabbit' => fake()->randomElement($rabbitNames),
            default => fake()->firstName(),
        };

        return [
            'name' => $name,
            'species' => $species,
            'age' => fake()->randomElement(['2 bulan', '6 bulan', '1 tahun', '2 tahun', '3 tahun', '5 tahun', 'tidak diketahui']),
            'gender' => fake()->randomElement(['male', 'female', 'unknown']),
            'condition' => fake()->sentence(),
            'status' => fake()->randomElement(['treatment', 'recovered', 'adopted', 'deceased']),
            'photo' => null,
        ];
    }
}
