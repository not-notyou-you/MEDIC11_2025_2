@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-4 text-center">
    <!-- Logo -->

    <div class="rounded-full bg-[#53b490] p-4 shadow-[0px_0px_20px_rgba(0,0,0,0.5) flex items-center justify-center shadow-lg]">
        <img src="{{ asset('images/logo.png') }}" alt="Logo"
        class="w-48 h-48 md:w-60 md:h-60 rounded-full object-cover shadow-[0px_0px_10px_rgba(0,0,0,0.3)]">
    </div>

    <!-- Judul -->
    <h1 class="text-[#222222] text-3xl font-bold mt-6 font-poppins">
        {{ $pageTitle ?? 'Halaman' }} Dalam Pengerjaan
    </h1>

    <!-- Pesan -->
    <p class="text-[#222222] mt-4 max-w-md font-roboto">
        Mohon maaf untuk sekarang halaman program kerja belum 
        tersedia. Silahkan datang di lain waktu.  
        <br><br>Terima kasih!
    </p>

    <!-- Tombol Kembali -->
    <a href="{{ route('home') }}" class="mt-6 bg-[#06D6A0] text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 hover:bg-[#05C295]">
        Kembali ke Home
    </a>
</div>

<x-footer />
@endsection
