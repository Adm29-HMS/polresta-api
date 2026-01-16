<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pejabat extends Model
{
    /** @use HasFactory<\Database\Factories\PejabatFactory> */
    use HasFactory;

    protected $table = 'pejabat';
    protected $fillable = [
        'nama',
        'nrp',
        'pangkat',
        'jabatan',
        'urutan',
        'foto',
    ];
}
