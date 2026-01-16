<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;

class KategoriBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Hukum',
            'Keamanan',
            'Kegiatan',
            'Press Release',
            'Inovasi'
        ];

        foreach ($categories as $cat) {
            KategoriBerita::firstOrCreate(
                ['nama' => $cat],
                ['slug' => Str::slug($cat)]
            );
        }
    }
}
