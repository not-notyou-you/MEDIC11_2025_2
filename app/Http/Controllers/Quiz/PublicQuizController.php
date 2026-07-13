<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('is_published', true)
                       ->withCount('questions')
                       ->get();
        
        return view('pages.quiz_public.index', [
            'quizzes' => $quizzes,
            'title' => 'Daftar Quiz'
        ]);
    }

    public function show(Quiz $quiz)
    {
        if (!$quiz->is_published) {
            abort(404);
        }

        $quiz->load('questions');
        
        return view('pages.quiz_public.play', [
            'quiz' => $quiz,
            'title' => $quiz->title
        ]);
    }

    public function saveAttempt(Request $request, Quiz $quiz)
    {
        try {
            if (!$quiz->is_published) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'Quiz not published'
                ], 404);
            }

            // Validasi input
            $request->validate([
                'score' => 'required|integer|min:0',
                'lives_used' => 'required|integer|min:0|max:3',
                'player_name' => 'nullable|string|max:255'
            ]);

            // Gunakan nama default jika kosong
            $playerName = $request->input('player_name');
            if (empty($playerName) || trim($playerName) === '') {
                $playerName = 'Anonim - ' . substr(uniqid(), -6);
            }

            // Simpan attempt
            $attempt = QuizAttempt::create([
                'quiz_id' => $quiz->id,
                'user_id' => null,
                'player_name' => $playerName,
                'score' => $request->score,
                'lives_used' => $request->lives_used,
            ]);

            return response()->json([
                'status' => 'success', 
                'attempt_id' => $attempt->id,
                'player_name' => $playerName,
                'redirect_url' => route('public.quiz.score', $quiz->id)
            ]);

        } catch (\Exception $e) {
            Log::error('Save attempt error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan skor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function score(Quiz $quiz)
    {
        if (!$quiz->is_published) {
            abort(404);
        }

        $quiz->load('questions');
        
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)
                               ->orderBy('created_at', 'desc')
                               ->get();

        return view('pages.quiz_public.score', [
            'quiz' => $quiz,
            'attempts' => $attempts,
            'title' => 'Score: ' . $quiz->title
        ]);
    }
}