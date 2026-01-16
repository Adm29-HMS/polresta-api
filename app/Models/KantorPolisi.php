<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KantorPolisi extends Model
{
    /** @use HasFactory<\Database\Factories\KantorPolisiFactory> */
    use HasFactory;

    protected $table = 'kantor_polisi';
    protected $fillable = [
        'nama',
        'tipe',
        'latitude',
        'longitude',
        'alamat',
        'telepon',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];
}
