<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Santri;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        Santri::factory()->count(10)->create(); // Menghasilkan 50 santri
    }
}
