<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nilai>
 */
class NilaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ulangan_1' => $this->faker->randomFloat(2, 0, 100),
            'ulangan_2' => $this->faker->randomFloat(2, 0, 100),
            'ulangan_3' => $this->faker->randomFloat(2, 0, 100),
            'santri_id' => \App\Models\Santri::factory(),
            'mapel_id' => \App\Models\MataPelajaran::factory(),
        ];
    }
}