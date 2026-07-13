<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatMinum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat',
        'dosis',
        'ketentuan',
        'komposisi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}