@extends('layouts.dashboard_template')
@section('title', 'Add New Quiz')

@section('content')
<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6 text-center">
        <h1 class="text-2xl font-semibold text-[#144034] mb-2">
            Add New Quiz
        </h1>
        <p class="text-lg text-[#144034]">Create a new quiz to add questions later</p>
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

    <!-- Add Quiz Form -->
    <!-- Add Quiz Form -->
    <div class="w-full max-w-7xl mx-auto">
        <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
            <form action="{{ route('admin.quiz.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-medium text-[#144034]">Quiz Title</label>
                    <input type="text" name="title" required 
                        class="border p-2 w-full rounded" 
                        value="{{ old('title') }}">
                    @error('title') 
                        <div class="text-red-600 mt-1">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit" 
                            class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                        Create Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
