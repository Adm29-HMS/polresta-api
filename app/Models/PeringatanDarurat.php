<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeringatanDarurat extends Model
{
    /** @use HasFactory<\Database\Factories\PeringatanDaruratFactory> */
    use HasFactory;

    protected $table = 'peringatan_darurat';
    protected $fillable = [
        'judul',
        'level',
        'lokasi',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
