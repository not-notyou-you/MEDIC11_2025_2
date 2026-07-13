<?php 

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'player_name',
        'score',
        'lives_used',
    ];

    protected $casts = [
        'score' => 'integer',
        'lives_used' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Tentukan nama tabel jika berbeda
    protected $table = 'quiz_attempts';

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}