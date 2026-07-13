<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAlat extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_nomor_hp',
        'nama_peminjam',
        'nim_peminjam',
        'barang_dipinjam',
        'lama_peminjaman',
        'status',
        'catatan_tambahan'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}