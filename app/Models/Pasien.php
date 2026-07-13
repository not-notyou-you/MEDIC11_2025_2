<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'keluhan',
        'jenis_penanganan',
        'penanganan_obat',
        'kecelakaan',
        'catatan_lanjutan',
        'persetujuan'
    ];

    protected $casts = [
        'penanganan_obat' => 'array',
        'kecelakaan' => 'array',
        'persetujuan' => 'boolean'
    ];
}