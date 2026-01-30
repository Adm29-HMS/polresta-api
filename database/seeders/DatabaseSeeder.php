<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User if not exists
        User::firstOrCreate(
            ['email' => 'admin@polresta.com'],
            [
                'name' => 'Admin Polresta',
                'password' => bcrypt('password'),
            ]
        );

        // Run other seeders
        $this->call([
            KategoriBeritaSeeder::class,
            BeritaSeeder::class,
            ProfilSeeder::class,
        ]);
    }
}
