<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profil;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profilData = [
            [
                'key' => 'Profil',
                'value' => '<p>Kepolisian Resor Kota (Polresta) Sorong Kota merupakan satuan pelaksana tugas kepolisian pada tingkat Kota yang berada di bawah naungan Kepolisian Daerah (Polda) Papua Barat. Polresta Sorong Kota bertugas menyelenggarakan tugas pokok kepolisian dalam memelihara keamanan dan ketertiban masyarakat, menegakkan hukum, serta memberikan perlindungan, pengayoman, dan pelayanan kepada masyarakat.</p><p>Wilayah hukum Polresta Sorong Kota mencakup seluruh Distrik yang ada di Kota Sorong, sebagai pintu gerbang utama di Tanah Papua. Kami berkomitmen untuk menciptakan situasi kamtibmas yang kondusif guna mendukung pembangunan nasional dan daerah.</p>'
            ],
            [
                'key' => 'Visi',
                'value' => '"Terwujudnya Polresta Sorong Kota di wilayah Kota Sorong yang aman, tertib, dan terkendali serta menjadi Kota Sorong yang makmur, adil dan sejahtera."'
            ],
            [
                'key' => 'Misi',
                'value' => '<ul class="space-y-3"><li>Mewujudkan Polresta Sorong Kota yang profesional, modern, dan dipercaya oleh masyarakat di wilayah Kota Sorong.</li><li>Melindungi, mengayomi dan melayani masyarakat dengan hati serta menjunjung tinggi negara persatuan dan kesatuan berdasarkan Pancasila dan UUD 1945.</li></ul>'
            ],
            [
                'key' => 'Sejarah',
                'value' => '<p>Kepolisian Resor Kota Sorong sebelumnya berstatus sebagai Polres Sorong Kota. Peningkatan status ini seiring dengan perkembangan Kota Sorong sebagai pusat pertumbuhan ekonomi dan pemerintahan di wilayah Papua Barat Daya.</p><p class="mt-4">Perkembangan dinamika masyarakat dan tantangan keamanan yang semakin kompleks menuntut kehadiran institusi kepolisian yang lebih kuat dan responsif. Polresta Sorong Kota terus berbenah diri, meningkatkan sarana dan prasarana, serta kualitas sumber daya manusia untuk memberikan pelayanan terbaik bagi masyarakat.</p>'
            ]
        ];

        foreach ($profilData as $data) {
            Profil::updateOrCreate(
                ['key' => $data['key']],
                ['value' => $data['value']]
            );
        }
    }
}
