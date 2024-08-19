<?php

namespace Database\Factories;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\Factory;

class SantriFactory extends Factory
{
    protected $model = Santri::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'orang_tua' => $this->faker->name,
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'id_kelas' => $this->faker->numberBetween(1, 10),
        ];
    }
}