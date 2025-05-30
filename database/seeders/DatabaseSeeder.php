<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            // UserGuruSeeder::class,
            // UserSiswaSeeder::class,
            // UserAdminSeeder::class,
            // IndustriSeeder::class,
            // PklSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
        ]);

        // Role::firstOrCreate(['name' => 'admin']);
        // Role::firstOrCreate(['name' => 'guru']);
        Role::firstOrCreate(['name' => 'siswa']);
    }
}
