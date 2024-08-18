<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataPelajaran>
 */
class MataPelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_mapel' => $this->faker->word(),
            'nama_mapel' => $this->faker->word(),
            'guru_id' => \App\Models\Guru::factory(),
            'kelas_id' => \App\Models\Kelas::factory(),
        ];
    }
}