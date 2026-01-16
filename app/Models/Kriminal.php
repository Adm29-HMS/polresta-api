<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriminal extends Model
{
    /** @use HasFactory<\Database\Factories\KriminalFactory> */
    use HasFactory;

    protected $table = 'kriminal';
    protected $fillable = [
        'no_laporan',
        'tanggal',
        'jenis',
        'status',
        'lokasi',
        'kronologi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
