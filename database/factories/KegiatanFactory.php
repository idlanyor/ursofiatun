<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kegiatan>
 */
class KegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kegiatan' => $this->faker->word(),
            'penanggung_jawab' => $this->faker->name(),
            'id_tahun_ajaran' => \App\Models\TahunAjaran::factory(),
            'periode' => $this->faker->randomElement(['Mingguan', 'Bulanan', 'Tahunan']),
            'tanggal_pelaksanaan' =>$this->faker->dateTimeBetween('2024-01-01', '2024-12-31'),
        ];
    }
}
