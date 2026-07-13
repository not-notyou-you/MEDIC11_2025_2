@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center px-4 md:px-24 lg:px-32 pt-16 md:pt-10 pb-10 space-y-10 w-full">
    <!-- JUDUL UTAMA -->
    <div class="w-full flex flex-col items-center text-center fade-zoom md:py-3">
        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Pengajuan Jasa Medis</h1>
        <h2 class="text-lg md:text-xl font-bold text-primary">Alat Kesehatan dan Tenaga Medis</h2>
    </div>

    <!-- KOTAK ISI -->
    <div class="w-full max-w-3xl rounded-xl bg-[#048C6A] p-6 md:p-10 shadow-[0px_0px_20px_rgba(0,0,0,0.3)] fade-zoom">
        @if (session()->has('status'))
            @include('components.status', ['status' => session('status')])
        @endif

        <h3 class="text-lg md:text-xl font-semibold text-[#ffffff] mb-2">Catatan:</h3>
        <ol class="list-decimal list-inside text-[#ffffff] text-sm md:text-base text-justify space-y-2 mb-4">
            <li>Pengajuan jasa harus diajukan minimal H-7 sebelum acara berlangsung.</li>
            <li>Anggota Medic wajib mendapatkan konsumsi yang layak apabila pengaju membutuhkan jasa medis selama 3 jam atau lebih. Jumlah konsumsi disesuaikan dengan jumlah tenaga medis yang diajukan.</li>
            <li>Pengaju wajib datang ke UKK apabila sudah dihubungi oleh pihak UMN Medical Center, untuk menandatangani form pengajuan.</li>
            <li>Anggota Medic wajib diperlakukan dengan baik sesuai aturan serta norma yang berlaku. Jika ditemukan perlakuan tidak baik terhadap anggota Medic, maka Medic berhak memberikan sanksi termasuk menarik anggota dan blacklist acara.</li>
        </ol>
        <p class="text-white text-sm md:text-base mb-4">
            Selebihnya, tercantum dalam
            <a href="https://bit.ly/SOPUMNMedicalCenter" class="font-bold underline hover:no-underline">SOP Eksternal UMN Medical Center</a>.
        </p>

        <hr class="border-white my-4">

        <ul class="text-white text-sm md:text-base mb-6 space-y-2">
            <li><a href="https://line.me/R/ti/p/@617rpkkn" target="_blank" class="underline hover:no-underline">Line Official Account</a></li>
            <li><a href="mailto:umnmedicalcenter@umn.ac.id" target="_blank" class="underline hover:no-underline">Email</a></li>
            <li><a href="https://www.instagram.com/umnmedicalcenter/" target="_blank" class="underline hover:no-underline">Instagram</a></li>
        </ul>

    
        <a href="{{ route('service.create') }}" class="flex justify-center">
            <button class="bg-[#effaf5] text-[#144034] border-2 border-[#144034] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#144034] hover:text-[#effaf5] transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#144034]">
                Form Pengajuan
            </button>
        </a>

    </div>
</div>

@endsection
