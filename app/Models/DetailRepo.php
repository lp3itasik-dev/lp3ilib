<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRepo extends Model
{
    use HasFactory;

    protected $fillable = [
        'series',
        'nama_kelompok',
        'nama_mhs',
        'nim',
        'major',
        'tahun_angkatan',
    ];

    protected $table = 'detailmhs';
}
