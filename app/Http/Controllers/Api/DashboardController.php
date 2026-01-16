<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Berita;
use App\Models\Kriminal;
use App\Models\Dpo;
use App\Models\OrangHilang;
use App\Models\Layanan;
use App\Models\StatistikKriminal;
use App\Models\StatistikLalulintas;
use App\Models\Pejabat;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'counts' => [
                'berita' => Berita::count(),
                'kriminal' => Kriminal::count(),
                'dpo' => Dpo::count(),
                'orang_hilang' => OrangHilang::count(),
                'layanan' => Layanan::count(),
                'pejabat' => Pejabat::count(),
            ],
            'statistik' => [
                'kriminal' => StatistikKriminal::orderBy('tahun')->orderBy('bulan')->get(),
                'lalulintas' => StatistikLalulintas::orderBy('tanggal', 'desc')->limit(30)->get(),
            ]
        ]);
    }
}
