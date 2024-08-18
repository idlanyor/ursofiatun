<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->date(),
            'jenis_absensi' => $this->faker->randomElement(['Hadir', 'Sakit', 'Izin', 'Alfa']),
            'keterangan' => $this->faker->sentence(),
            'santri_id' => \App\Models\Santri::factory(),
        ];
    }
}