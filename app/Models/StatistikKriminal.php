<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikKriminal extends Model
{
    /** @use HasFactory<\Database\Factories\StatistikKriminalFactory> */
    use HasFactory;

    protected $table = 'statistik_kriminal';
    protected $fillable = [
        'bulan',
        'tahun',
        'jumlah_kasus',
    ];
}
