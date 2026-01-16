<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PejabatController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\KategoriBeritaController;
use App\Http\Controllers\Api\KriminalController;
use App\Http\Controllers\Api\DpoController;
use App\Http\Controllers\Api\OrangHilangController;
use App\Http\Controllers\Api\PeringatanDaruratController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\PeraturanController;
use App\Http\Controllers\Api\KantorPolisiController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\DashboardController;
// Note: Statistik controllers if they exist or logic in Dashboard
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\StatistikLalulintasController;
use App\Http\Controllers\Api\StatistikKriminalController;
use App\Http\Controllers\Api\PrestasiController;
use App\Http\Controllers\Api\ProgramController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth Public
Route::post('/login', [AuthController::class, 'login']);

// Public Read-Only Routes
Route::get('/pejabat', [PejabatController::class, 'index']);
Route::get('/pejabat/{pejabat}', [PejabatController::class, 'show']);

Route::get('/kategori-berita', [KategoriBeritaController::class, 'index']);
Route::get('/kategori-berita/{kategoriBerita}', [KategoriBeritaController::class, 'show']);

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{berita}', [BeritaController::class, 'show']);

Route::get('/kriminal', [KriminalController::class, 'index']);
Route::get('/kriminal/{kriminal}', [KriminalController::class, 'show']);

Route::get('/dpo', [DpoController::class, 'index']);
Route::get('/dpo/{dpo}', [DpoController::class, 'show']);

Route::get('/orang-hilang', [OrangHilangController::class, 'index']);
Route::get('/orang-hilang/{orangHilang}', [OrangHilangController::class, 'show']);

Route::get('/peringatan-darurat', [PeringatanDaruratController::class, 'index']);
Route::get('/peringatan-darurat/{peringatanDarurat}', [PeringatanDaruratController::class, 'show']);

Route::get('/media', [MediaController::class, 'index']);
Route::get('/media/{media}', [MediaController::class, 'show']);

Route::get('/peraturan', [PeraturanController::class, 'index']);
Route::get('/peraturan/{peraturan}', [PeraturanController::class, 'show']);

Route::get('/kantor-polisi', [KantorPolisiController::class, 'index']);
Route::get('/kantor-polisi/{kantorPolisi}', [KantorPolisiController::class, 'show']);

Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/layanan/{layanan}', [LayananController::class, 'show']);

Route::get('/profil', [ProfilController::class, 'index']);
Route::get('/profil/{profil}', [ProfilController::class, 'show']);

Route::get('/dashboard/stats', [DashboardController::class, 'index']);

// Public Statistics
Route::get('/statistik/kriminal', [StatistikController::class, 'kriminal']);
Route::get('/statistik/lalulintas', [StatistikController::class, 'lalulintas']);

// Protected Admin Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('/pejabat', PejabatController::class)->except(['index', 'show']);
    Route::apiResource('/kategori-berita', KategoriBeritaController::class)->except(['index', 'show']);
    Route::apiResource('/berita', BeritaController::class)->except(['index', 'show']);
    Route::apiResource('/kriminal', KriminalController::class)->except(['index', 'show']);
    Route::apiResource('/dpo', DpoController::class)->except(['index', 'show']);
    Route::apiResource('/orang-hilang', OrangHilangController::class)->except(['index', 'show']);
    Route::apiResource('/peringatan-darurat', PeringatanDaruratController::class)->except(['index', 'show']);
    Route::apiResource('/media', MediaController::class)->except(['index', 'show']);
    Route::apiResource('/peraturan', PeraturanController::class)->except(['index', 'show']);
    Route::apiResource('/kantor-polisi', KantorPolisiController::class)->except(['index', 'show']);
    Route::apiResource('/layanan', LayananController::class)->except(['index', 'show']);
    Route::apiResource('/profil', ProfilController::class)->except(['index', 'show']);
    
    // Statistik Manually
    Route::apiResource('/statistik-lalulintas', StatistikLalulintasController::class)->except(['create', 'edit']);
    Route::apiResource('/statistik-kriminal', StatistikKriminalController::class)->except(['create', 'edit']);
    Route::apiResource('/prestasi', PrestasiController::class)->except(['index', 'show']);
    Route::apiResource('/programs', ProgramController::class)->except(['index', 'show']);
});

// Public Prestasi
Route::get('/prestasi', [PrestasiController::class, 'index']);
Route::get('/prestasi/{prestasi}', [PrestasiController::class, 'show']);

// Public Programs
Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/programs/{program}', [ProgramController::class, 'show']);
