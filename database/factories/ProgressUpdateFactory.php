<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgressUpdate>
 */
class ProgressUpdateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $updateTitles = [
            'Pemeriksaan Awal di Klinik Hewan',
            'Update: Kondisi Mulai Membaik',
            'Pemberian Vaksin dan Vitamin',
            'Operasi Berhasil Dilakukan',
            'Progress Recovery - Minggu Ke-1',
            'Siap untuk Diadopsi',
            'Pembelian Makanan dan Obat',
            'Sterilisasi Selesai',
        ];

        return [
            'title' => fake()->randomElement($updateTitles),
            'description' => fake()->paragraph(3),
            'expense_amount' => fake()->numberBetween(50000, 2000000),
            'photo' => null,
        ];
    }
}
