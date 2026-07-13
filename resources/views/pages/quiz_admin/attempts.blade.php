@extends('layouts.dashboard_template')
@section('title', 'Quiz Attempts "' . $quiz->title . '"')
@section('content')
<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-[#144034] mb-2">
                    Attempts: "{{ $quiz->title }}"
                </h1>
                <p class="text-[#144034]">Total: {{ $attempts->count() }} attempts</p>
            </div>
            <a href="{{ route('admin.quiz.index') }}" 
               class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg hover:bg-[#048C6A] hover:text-white transition">
               Kembali
            </a>
        </div>
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

    <!-- Table Content -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        @if($attempts->isEmpty())
            <div class="min-h-96 flex flex-col items-center justify-center p-10 border border-dashed border-[#048C6A] rounded-lg">
            <i class="ri-folder-open-line text-6xl text-[#048C6A] mb-4"></i>
            <p class="text-xl font-semibold text-center text-[#144034]">No Attempts found</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-[#048C6A]/10">
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            No
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            Nama Pemain
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            Score
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            Lives Digunakan
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left border-r border-[#048C6A]/20">
                            Tanggal
                        </th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-3 px-4 text-left">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attempts as $i => $a)
                    <tr class="hover:bg-[#e0f2e9] {{ $i % 2 == 0 ? 'bg-gray-100' : '' }} transition">
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 text-[#144034] font-medium">
                            {{ $i + 1 }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 text-[#144034] font-medium">
                            {{ $a->player_name ?? ($a->user?->name ?? 'Anonim') }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 font-bold text-[#048C6A]">
                            {{ $a->score }}/{{ $quiz->questions->count() }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 font-medium text-[#144034]">
                            {{ $a->lives_used }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20 font-medium text-[#144034]">
                            {{ $a->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="py-3 px-4 border-b border-[#048C6A]/20">
                            <form action="{{ route('admin.quiz.attempts.delete', $a->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus attempt ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg text-sm font-medium transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection