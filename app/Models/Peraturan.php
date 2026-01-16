<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    /** @use HasFactory<\Database\Factories\PeraturanFactory> */
    use HasFactory;

    protected $table = 'peraturan';
    protected $fillable = [
        'nomor',
        'tahun',
        'tentang',
        'file_path',
    ];
}
