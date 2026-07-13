@extends('layouts.dashboard_template')

@section('content')
<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <h1 class="text-2xl font-semibold text-[#144034] text-center mb-2">
            Quiz Management
        </h1>
        <p class="text-center text-lg text-[#144034]">Organize and manage your quizzes</p>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
    <div class="mb-6">
        <div class="flex items-center p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-[#e7f8f1]"
            role="alert">
            <svg class="flex-shrink-0 inline w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 3.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5Zm1.25 11h-2.5a.75.75 0 0 1 0-1.5H9V9.75H8.5a.75.75 0 0 1 0-1.5h1.75a.75.75 0 0 1 .75.75v5H11.25a.75.75 0 0 1 0 1.5Z" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Flash Message Error -->
    @if (session('error'))
    <div class="mb-6">
        <div class="flex items-center p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-[#fde8e8]" role="alert">
            <svg class="flex-shrink-0 inline w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-5 space-y-3 sm:space-y-0">
            <h2 class="text-xl font-semibold text-[#144034]">Quiz List</h2>
            <a href="{{ route('admin.quiz.create') }}"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                + Add New Quiz
            </a>
        </div>

        @if ($quizzes->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-[#048C6A]/10">
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left rounded-tl-md border-r border-[#048C6A]/20">
                            No
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            Quiz Title
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            Date Added
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left rounded-tr-md">
                            Action
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-[#144034]">Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $i => $quiz)
                    <tr class="hover:bg-[#e0f2e9] transition">
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 text-[#144034] font-medium">
                            {{ $i + 1 }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 font-semibold text-[#144034]">
                            {{ $quiz->title }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 font-medium text-[#144034]">
                            {{ $quiz->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20">
                            <a href="{{ route('admin.quiz.manage', $quiz->id) }}"
                                class="inline-block border-2 border-blue-600 text-blue-600 font-semibold px-3 py-1 rounded-lg shadow-sm hover:bg-blue-600 hover:text-white transition">
                                Manage
                            </a>
                            <form action="{{ route('admin.quiz.publish', $quiz->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-block border-2 {{ $quiz->is_published ? 'border-red-600 text-red-600 hover:bg-red-600 hover:text-white' : 'border-green-600 text-green-600 hover:bg-green-600 hover:text-white' }} font-semibold px-3 py-1 rounded-lg shadow-sm transition
                                    {{ $quiz->questions->count() == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $quiz->questions->count() == 0 ? 'disabled' : '' }}>
                                    {{ $quiz->is_published ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.quiz.destroy', $quiz->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block border-2 border-red-600 text-red-600 font-semibold px-3 py-1 rounded-lg shadow-sm hover:bg-red-600 hover:text-white transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.quiz.attempts', $quiz->id) }}" 
                            class="inline-block border-2 border-blue-600 text-blue-600 font-semibold px-3 py-1 rounded-lg shadow-sm hover:bg-blue-600 hover:text-white transition">
                            Score
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div
            class="min-h-96 flex flex-col items-center justify-center p-10 border border-dashed border-[#048C6A] rounded-lg">
            <i class="ri-folder-open-line text-6xl text-[#048C6A] mb-4"></i>
            <p class="text-xl font-semibold text-center text-[#144034]">No quizzes found</p>
            <p class="text-center text-gray-500 mt-2">Start by creating your first quiz</p>
        </div>
        @endif
    </div>
</div>
@endsection
