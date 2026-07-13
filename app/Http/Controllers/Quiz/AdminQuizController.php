<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizAttempt;

class AdminQuizController extends Controller
{
    public function index()
    {
        return view('pages.quiz_admin.index', [
            'title' => 'Quiz List'
        ]);
    }

    public function attempts(Quiz $quiz)
    {
        $attempts = $quiz->attempts()->with('user')->get();

        return view('pages.quiz_admin.attempts', [
            'quiz' => $quiz,
            'attempts' => $attempts
        ]);
    }

    public function showAttempts(Quiz $quiz)
    {
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)
                               ->with('user')
                               ->get();

        return view('pages.quiz_admin.attempts', [
            'quiz' => $quiz,
            'attempts' => $attempts,
            'title' => 'Quiz Attempts: ' . $quiz->title
        ]);
    }
}