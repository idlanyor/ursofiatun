<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TahunAjaranSeeder::class,
            // KelasSeeder::class,
            // SantriSeeder::class,
            // GuruSeeder::class,
            // KegiatanSeeder::class,
            // AbsensiSeeder::class,
            // MataPelajaranSeeder::class,
            // NilaiSeeder::class,
        ]);
    }
}
