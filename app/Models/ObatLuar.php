<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatLuar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat',
        'ketentuan',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}