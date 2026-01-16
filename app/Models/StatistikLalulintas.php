<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikLalulintas extends Model
{
    /** @use HasFactory<\Database\Factories\StatistikLalulintasFactory> */
    use HasFactory;

    protected $table = 'statistik_lalulintas';
    protected $fillable = [
        'bulan',
        'tahun',
        'pelanggaran',
        'kecelakaan',
    ];

    protected $casts = [];
}
