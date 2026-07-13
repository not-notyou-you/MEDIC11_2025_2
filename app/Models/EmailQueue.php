<?php
// app/Models/EmailQueue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'email_queue';

    protected $fillable = [
        'email',
        'email_content',
        'email_subject',
        'variables',
        'is_sent',
        'sent_at'
    ];

    protected $casts = [
        'variables' => 'array',
        'sent_at' => 'datetime'
    ];
}