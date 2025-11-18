<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RescueCase>
 */
class RescueCaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Rescue Urgent: Anjing Terlantar di Jalanan',
            'Kucing Sakit Butuh Perawatan Medis',
            'Puppies Ditinggalkan di Kardus',
            'Anjing Senior Butuh Rumah Baru',
            'Rescue Kucing dari Banjir',
            'Hewan Terlantar Butuh Bantuan',
            'Anjing Kecelakaan Butuh Operasi',
            'Kucing Liar Butuh Sterilisasi',
        ];

        $targetAmount = fake()->numberBetween(1000000, 10000000);
        $currentAmount = fake()->numberBetween(0, $targetAmount);

        return [
            'title' => fake()->randomElement($titles),
            'description' => fake()->paragraph(5),
            'location' => fake()->city() . ', ' . fake()->state(),
            'target_amount' => $targetAmount,
            'current_amount' => $currentAmount,
            'status' => fake()->randomElement(['active', 'completed', 'urgent', 'closed']),
            'thumbnail' => null,
        ];
    }

    /**
     * Indicate that the rescue case is urgent.
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'urgent',
        ]);
    }

    /**
     * Indicate that the rescue case is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}
