<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    /** @use HasFactory<\Database\Factories\LayananFactory> */
    use HasFactory;

    protected $table = 'layanan';
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'icon',
        'persyaratan',
        'prosedur',
    ];
}
