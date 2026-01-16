<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrangHilang extends Model
{
    /** @use HasFactory<\Database\Factories\OrangHilangFactory> */
    use HasFactory;

    protected $table = 'orang_hilang';
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'usia',
        'tanggal_hilang',
        'lokasi_terakhir',
        'ciri',
        'kontak',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_hilang' => 'date',
    ];
}
