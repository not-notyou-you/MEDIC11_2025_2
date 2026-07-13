<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function manage($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        return view('pages.quiz_admin.manage', [
            'quiz' => $quiz,
            'title' => 'Manage Quiz: ' . $quiz->title
        ]);
    }

    public function store(Request $request, $quizId)
    {
        $request->validate([
            'question' => 'required',
            'correct_answer' => 'required',
        ]);

        Question::create([
            'quiz_id' => $quizId,
            'question' => $request->question,
            'wrong_answer1' => $request->wrong_answer1,
            'wrong_answer2' => $request->wrong_answer2,
            'wrong_answer3' => $request->wrong_answer3,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('pages.quiz_admin.edit', [
            'question' => $question,
            'title' => 'Edit Question',
        ]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $request->validate([
            'question' => 'required',
            'correct_answer' => 'required',
        ]);

        $question->update([
            'question' => $request->question,
            'wrong_answer1' => $request->wrong_answer1,
            'wrong_answer2' => $request->wrong_answer2,
            'wrong_answer3' => $request->wrong_answer3,
            'correct_answer' => $request->correct_answer,
        ]);

        return redirect()->route('admin.quiz.manage', $question->quiz_id)
                         ->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()->route('admin.quiz.manage', $quizId)
                         ->with('success', 'Pertanyaan berhasil dihapus!');
    }
}