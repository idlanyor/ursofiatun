<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'nama' => 'Roynaldi',
            'username' => 'idlanyor',
            'password' => Hash::make('ngeteh789'),
            'role' => 'admin',
        ]);

        User::factory()->count(10)->create();
    }
}
