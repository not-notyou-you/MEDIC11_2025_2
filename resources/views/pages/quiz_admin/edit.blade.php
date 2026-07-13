@extends('layouts.dashboard_template')
@section('title', 'Edit Question')

@section('content')
<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6 text-center">
        <h1 class="text-2xl font-semibold text-[#144034] mb-2">
            Edit Question
        </h1>
        <p class="text-lg text-[#144034]">Modify the question and its answers</p>
        <div class="mt-4">
            <a href="{{ url()->previous() }}" 
               class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
               ← Back
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

    <!-- Edit Question Form -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium text-[#144034]">Question</label>
                <textarea name="question" class="border p-2 w-full rounded" required rows="3">{{ old('question', $question->question) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Wrong Answer 1</label>
                    <textarea name="wrong_answer1" rows="3" class="border p-2 w-full rounded overflow-y-auto">{{ old('wrong_answer1', $question->wrong_answer1) }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Wrong Answer 2</label>
                    <textarea name="wrong_answer2" rows="3" class="border p-2 w-full rounded overflow-y-auto">{{ old('wrong_answer2', $question->wrong_answer2) }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Wrong Answer 3</label>
                    <textarea name="wrong_answer3" rows="3" class="border p-2 w-full rounded overflow-y-auto">{{ old('wrong_answer3', $question->wrong_answer3) }}</textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Correct Answer</label>
                    <textarea name="correct_answer" rows="3" class="border p-2 w-full rounded overflow-y-auto" required>{{ old('correct_answer', $question->correct_answer) }}</textarea>
                </div>
            </div>

            <div class="flex gap-2 mt-3">
                <button type="submit" class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                    Save Changes
                </button>
                <a href="{{ url()->previous() }}" class="border-2 border-gray-500 text-gray-500 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-gray-500 hover:text-white transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
