<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpo extends Model
{
    /** @use HasFactory<\Database\Factories\DpoFactory> */
    use HasFactory;

    protected $table = 'dpo';
    protected $fillable = [
        'nomor_surat',
        'nama',
        'alias',
        'kasus',
        'ciri_fisik',
        'foto',
        'status',
    ];
}
