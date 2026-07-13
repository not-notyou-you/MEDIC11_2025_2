<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'wrong_answer1',
        'wrong_answer2',
        'wrong_answer3',
        'correct_answer',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
