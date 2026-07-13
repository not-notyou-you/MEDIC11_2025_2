<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\Question;
use App\Models\Quiz\QuizAttempt;

class QuizController extends Controller
{
    // ==================== ADMIN FUNCTIONS ====================
    
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'asc')->get();
        return view('pages.quiz_admin.index', [
            'quizzes' => $quizzes,
            'title' => 'Kelola Quiz',
        ]);
    }

    public function create()
    {
        return view('pages.quiz_admin.create', [
            'title' => 'Tambah Quiz',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:255']);
        $quiz = Quiz::create($data);
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz created');
    }

    public function manage(Quiz $quiz)
    {
        $quiz->load('questions');
        return view('pages.quiz_admin.manage', [
            'quiz' => $quiz,
            'title' => 'Manage Quiz: ' . $quiz->title
        ]);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz berhasil dihapus.');
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'wrong_answer1' => 'nullable|string|max:255',
            'wrong_answer2' => 'nullable|string|max:255',
            'wrong_answer3' => 'nullable|string|max:255',
            'correct_answer' => 'required|string|max:255',
        ]);

        $data['quiz_id'] = $quiz->id;
        Question::create($data);

        return redirect()->route('admin.quiz.manage', $quiz->id)->with('success', 'Question added.');
    }

    public function destroyQuestion(Question $question)
    {
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('admin.quiz.manage', $quizId)->with('success', 'Question deleted.');
    }

    public function showAttempts(Quiz $quiz)
    {
        $attempts = $quiz->attempts()->with('user')->orderBy('created_at', 'desc')->get();
        return view('pages.quiz_admin.attempts', [
            'quiz' => $quiz,
            'attempts' => $attempts,
            'title' => 'Quiz Attempts: ' . $quiz->title
        ]);
    }

    public function togglePublish(Quiz $quiz)
    {
        if ($quiz->questions()->count() == 0) {
            return redirect()->back()->with('error', 'Quiz belum memiliki soal, tidak bisa dipublish.');
        }

        $quiz->is_published = !$quiz->is_published;
        $quiz->save();

        $status = $quiz->is_published ? 'published' : 'unpublished';
        return redirect()->back()->with('success', "Quiz \"{$quiz->title}\" berhasil $status.");
    }

    public function deleteAttempt($id)
    {
        try {
            $attempt = QuizAttempt::findOrFail($id);
            $quizId = $attempt->quiz_id;
            $attempt->delete();
            
            return redirect()->route('admin.quiz.attempts', $quizId)
                            ->with('success', 'Attempt berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Gagal menghapus attempt: ' . $e->getMessage());
        }
    }
}