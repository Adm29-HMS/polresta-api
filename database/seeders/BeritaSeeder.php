<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $categories = KategoriBerita::all();

        $sampleNews = [
            [
                'kategori' => 'Hukum',
                'judul' => 'Polresta Sorong Kota Gelar Sosialisasi Peraturan Lalu Lintas Terbaru',
                'isi' => '<p>Dalam rangka meningkatkan kesadaran masyarakat tentang peraturan lalu lintas, Polresta Sorong Kota menggelar sosialisasi mengenai aturan terbaru yang berlaku mulai tahun ini.</p><p>Kegiatan ini dihadiri oleh ratusan warga yang antusias mengikuti penjelasan dari Tim Satlantas Polresta Sorong Kota.</p><p>"Kami berharap dengan adanya sosialisasi ini, tingkat pelanggaran lalu lintas di Sorong Kota dapat menurun secara signifikan," ujar Kasat Lantas.</p>',
            ],
            [
                'kategori' => 'Keamanan',
                'judul' => 'Operasi Cipta Kondisi Berhasil Amankan Wilayah Jelang Natal dan Tahun Baru',
                'isi' => '<p>Polresta Sorong Kota melaksanakan Operasi Cipta Kondisi dalam rangka pengamanan Natal dan Tahun Baru 2026. Operasi ini berhasil mengamankan berbagai titik rawan kriminalitas di wilayah Sorong Kota.</p><p>Personel gabungan dari berbagai satuan bertugas melakukan patroli intensif selama 24 jam.</p><p>Kapolresta menyampaikan apresiasi kepada seluruh anggota yang telah bekerja keras menjaga keamanan masyarakat.</p>',
            ],
            [
                'kategori' => 'Kegiatan',
                'judul' => 'Kapolresta Sorong Kota Kunjungi Panti Asuhan dalam Rangka Bakti Sosial',
                'isi' => '<p>Dalam rangka memperingati Hari Bhayangkara ke-79, Kapolresta Sorong Kota beserta jajaran mengunjungi Panti Asuhan Kasih Ibu.</p><p>Kunjungan ini diisi dengan berbagai kegiatan sosial termasuk pemberian donasi, sembako, dan perlengkapan sekolah kepada anak-anak panti.</p><p>"Ini adalah bentuk kepedulian kami terhadap sesama. Polri hadir untuk melindungi dan mengayomi seluruh lapisan masyarakat," kata Kapolresta.</p>',
            ],
            [
                'kategori' => 'Press Release',
                'judul' => 'Polresta Sorong Kota Ungkap Kasus Pencurian Kendaraan Bermotor',
                'isi' => '<p>Tim Reskrim Polresta Sorong Kota berhasil mengungkap kasus pencurian kendaraan bermotor (Curanmor) yang meresahkan warga.</p><p>Tersangka berinisial AS (32) ditangkap di kediamannya bersama barang bukti 3 unit sepeda motor hasil curian.</p><p>"Kami mengimbau masyarakat untuk selalu waspada dan segera melaporkan bila menemukan aktivitas mencurigakan," ujar Kasat Reskrim.</p>',
            ],
            [
                'kategori' => 'Inovasi',
                'judul' => 'Polresta Sorong Kota Luncurkan Aplikasi Pengaduan Online "LAPOR SORONG"',
                'isi' => '<p>Polresta Sorong Kota meluncurkan inovasi terbaru berupa aplikasi pengaduan online bernama "LAPOR SORONG".</p><p>Aplikasi ini memudahkan masyarakat untuk melaporkan berbagai kejadian atau gangguan keamanan secara real-time langsung ke sistem Polresta.</p><p>"Dengan aplikasi ini, kami ingin memangkas birokrasi dan mempercepat respons terhadap laporan masyarakat," jelas Kapolresta saat peluncuran.</p>',
            ],
            [
                'kategori' => 'Keamanan',
                'judul' => 'Patroli Malam Intensif untuk Cegah Kriminalitas di Kawasan Perniagaan',
                'isi' => '<p>Satuan Sabhara Polresta Sorong Kota meningkatkan intensitas patroli malam di kawasan perniagaan.</p><p>Langkah ini diambil menyusul laporan beberapa kasus pencurian yang terjadi pada malam hari.</p><p>Dengan penambahan personel dan jam patroli, diharapkan rasa aman masyarakat dapat terjaga.</p>',
            ],
            [
                'kategori' => 'Hukum',
                'judul' => 'Penyuluhan Hukum kepada Pelajar SMA tentang Bahaya Narkoba',
                'isi' => '<p>Sat Binmas Polresta Sorong Kota mengadakan penyuluhan hukum kepada pelajar SMA Negeri 1 Sorong.</p><p>Materi yang disampaikan meliputi bahaya narkoba dan sanksi hukum bagi pelaku penyalahgunaan.</p><p>Para siswa tampak antusias dan aktif bertanya saat sesi diskusi.</p>',
            ],
            [
                'kategori' => 'Kegiatan',
                'judul' => 'Polresta Sorong Kota Gelar Donor Darah Massal',
                'isi' => '<p>Dalam rangka HUT Bhayangkara, Polresta Sorong Kota bekerja sama dengan PMI menggelar kegiatan donor darah massal.</p><p>Kegiatan ini diikuti oleh ratusan anggota dan masyarakat umum yang ingin berkontribusi.</p><p>Darah yang terkumpul akan disalurkan kepada yang membutuhkan melalui PMI Sorong.</p>',
            ],
            [
                'kategori' => 'Press Release',
                'judul' => 'Penangkapan Pelaku Penipuan Online yang Merugikan Puluhan Juta Rupiah',
                'isi' => '<p>Unit Cyber Crime Polresta Sorong Kota berhasil menangkap pelaku penipuan online.</p><p>Tersangka menggunakan modus jual beli barang elektronik fiktif melalui media sosial.</p><p>Total kerugian korban diperkirakan mencapai Rp 75 juta dari berbagai korban di seluruh Indonesia.</p>',
            ],
        ];

        foreach ($sampleNews as $index => $news) {
            $kategori = $categories->firstWhere('nama', $news['kategori']);
            
            if ($kategori) {
                Berita::firstOrCreate(
                    ['judul' => $news['judul']],
                    [
                        'slug' => Str::slug($news['judul']),
                        'ringkasan' => Str::limit(strip_tags($news['isi']), 150),
                        'konten' => $news['isi'],
                        'cover' => null,
                        'kategori_id' => $kategori->id,
                        'penulis' => $user?->name ?? 'Admin',
                        'is_published' => true,
                        'published_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                    ]
                );
            }
        }
    }
}
