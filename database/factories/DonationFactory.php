<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentStatus = fake()->randomElement(['success', 'pending', 'failed']);
        $messages = [
            'Semoga cepat sembuh!',
            'Terima kasih sudah menolong hewan-hewan ini',
            'Donasi untuk kesehatan mereka',
            'Semangat untuk rescuernya!',
            'Semoga bisa membantu',
            null,
        ];

        return [
            'amount' => fake()->randomElement([50000, 100000, 200000, 500000, 1000000]),
            'payment_method' => 'midtrans',
            'payment_status' => $paymentStatus,
            'midtrans_order_id' => $paymentStatus === 'success' ? 'ORDER-' . fake()->unique()->numerify('##########') : null,
            'midtrans_snap_token' => null,
            'message' => fake()->randomElement($messages),
            'is_anonymous' => fake()->boolean(30), // 30% anonymous
            'paid_at' => $paymentStatus === 'success' ? fake()->dateTimeBetween('-30 days', 'now') : null,
        ];
    }

    /**
     * Indicate that the donation is successful.
     */
    public function successful(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'success',
            'midtrans_order_id' => 'ORDER-' . fake()->unique()->numerify('##########'),
            'paid_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    /**
     * Indicate that the donation is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'pending',
            'midtrans_order_id' => null,
            'paid_at' => null,
        ]);
    }
}
