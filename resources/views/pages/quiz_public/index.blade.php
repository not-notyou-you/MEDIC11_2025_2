@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <h2 class="text-5xl font-bold text-[#144034] text-center">Quiz Medic</h2>
    <h2 class="text-2xl font-bold text-[#144034] mb-8 text-center">Pilih Quiz yang Mau Kamu Kerjakan</h2> 

    @if($quizzes->isEmpty())
        <p class="text-center text-gray-500">Belum ada quiz yang tersedia.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quizzes as $quiz)
            <div class="bg-white shadow-2xl rounded-xl overflow-hidden flex flex-col">
                <!-- Card Header -->
                <div class="bg-[#048C6A] px-6 py-4">
                    <h3 class="text-xl font-bold text-white">{{ $quiz->title }}</h3>
                </div>

                <!-- Card Content -->
                <div class="p-6 flex flex-col justify-between flex-grow">
                    <div>
                        <p class="text-gray-700 mb-2"><strong>Jumlah Soal:</strong> {{ $quiz->questions_count }}</p>
                        <p class="text-gray-700 mb-4"><strong>Dibuat pada:</strong> {{ $quiz->created_at->format('d M Y') }}</p>
                    </div>

                    <div class="flex justify-between mt-4 gap-2">
                        <a href="{{ route('public.quiz.play', $quiz->id) }}" 
                        class="btn-start bg-[#048C6A] hover:bg-[#144034] text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Mulai Quiz
                        </a>
                        <a href="{{ route('public.quiz.score', $quiz->id) }}" 
                        class="btn-score bg-[#F59E0B] hover:bg-[#B45309] text-white px-6 py-2 rounded-xl font-semibold transition-colors">
                        Lihat Score
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
