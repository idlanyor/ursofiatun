<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TahunAjaran>
 */
class TahunAjaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tahun_mulai' => $this->faker->year(),
            'tahun_akhir' => $this->faker->year(),
            'status' => $this->faker->randomElement(['aktif', 'tidak aktif']),
        ];
    }
}