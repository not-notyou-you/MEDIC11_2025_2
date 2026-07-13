@extends('layouts.dashboard_template')

@section('title', 'Manage Quiz')
@section('content')

<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6 text-center">
        <h1 class="text-2xl font-semibold text-[#144034] mb-2">
            Manage Quiz: {{ $quiz->title }}
        </h1>
        <p class="text-lg text-[#144034]">Add and organize questions for this quiz</p>
        <div class="mt-4">
            <a href="{{ route('admin.quiz.index') }}" 
               class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
               ← Back to Quiz List
            </a>
        </div>
    </div>

    <!-- Flash Message -->
    @if(session()->has('success'))
    <div class="mb-6">
        <div class="flex items-center p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 lg:w-5 lg:h-5 me-3" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm1 15H9v-2h2Zm0-4H9V5h2Z" />
            </svg>
            <p class="text-sm font-medium">{{ session()->get('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Add Question Form -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <h2 class="text-xl font-semibold text-[#144034] mb-4">Add New Question</h2>

        <form action="{{ route('admin.quiz.questions.store', $quiz->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium text-[#144034]">Question</label>
                <textarea name="question" class="border p-2 w-full rounded" required>{{ old('question') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Wrong Answer 1</label>
                    <textarea name="wrong_answer1" rows="3" class="border p-2 w-full rounded overflow-y-auto">{{ old('wrong_answer1') }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Wrong Answer 2</label>
                    <textarea name="wrong_answer2" rows="3" class="border p-2 w-full rounded overflow-y-auto">{{ old('wrong_answer2') }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Wrong Answer 3</label>
                    <textarea name="wrong_answer3" rows="3" class="border p-2 w-full rounded overflow-y-auto">{{ old('wrong_answer3') }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Correct Answer</label>
                    <textarea name="correct_answer" rows="3" class="border p-2 w-full rounded overflow-y-auto" required>{{ old('correct_answer') }}</textarea>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                    Add Question
                </button>
            </div>
        </form>
    </div>

    <!-- Question List -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        <h2 class="text-xl font-semibold text-[#144034] mb-4">Questions List</h2>
        @if($quiz->questions->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead class="bg-[#048C6A]/10">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-[#144034] border-r border-[#048C6A]/20">No</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-[#144034] border-r border-[#048C6A]/20">Question</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-[#144034]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quiz->questions as $idx => $q)
                    <tr class="hover:bg-[#e0f2e9] border-b border-[#048C6A]/20">
                        <td class="py-2 px-4">{{ $idx+1 }}</td>
                        <td class="py-2 px-4">{{ \Illuminate\Support\Str::limit($q->question, 120) }}</td>
                        <td class="py-2 px-4 flex gap-2">
                            <a href="{{ route('admin.questions.edit', $q->id) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                               Edit
                            </a>
                            <form action="{{ route('admin.questions.destroy', $q->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="min-h-48 flex flex-col items-center justify-center p-10 border border-dashed border-[#048C6A] rounded-lg">
           <i class="ri-question-line text-6xl text-[#048C6A] mb-4"></i>
            <p class="text-xl font-semibold text-[#144034] text-center">No questions found</p>
            <p class="text-center text-gray-500 mt-2">Start by adding a new question</p>
        </div>
        @endif
    </div>
</div>

@endsection
