@extends('layouts.app')

@section('content')
<div class="bg-[#d9f2e5] px-5 py-10">
    <form action="{{ route('service.store') }}" method="POST" class="w-full max-w-3xl mx-auto">
        @csrf

        <div class="text-left mt-14 mb-4">
            <h1 class="text-xl lg:text-2xl font-bold text-[#048C6A]">Form Pengajuan Jasa<br>Alat Kesehatan dan Medis</h1>
        </div>

        <x-form-group name="email" label="Email" />
        <x-form-group name="name" label="Nama Lengkap" />
        <x-form-group name="nim" label="NIM" type="number" placeholder="12345 (Tanpa 000)" />
        <x-form-group name="type" label="Tipe Pengajuan" :options="['Pengajuan Jasa' => 'Pengajuan Jasa', 'Alat Kesehatan' => 'Alat Kesehatan']" />

        {{-- Input Jumlah Orang (Hanya untuk Pengajuan Jasa) --}}
        <div id="person-wrapper">
            <x-form-group name="person" label="Jumlah Orang" type="number" :min="0" note="Hanya untuk Pengajuan Jasa" />
        </div>

        {{-- Input Alat Kesehatan (Hanya untuk Alat Kesehatan) --}}
        <div id="medical-equipment-wrapper" class="hidden px-10 pt-30 pb-10">
            <label class="block text-sm font-bold text-[#048C6A] mb-4">Pilih Alat Kesehatan</label>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @php
                    $equipmentList = [
                        'kursi roda' => 'Kursi Roda',
                        'tabung oksigen' => 'Tabung Oksigen',
                        'tandu lipat' => 'Tandu Lipat',
                        'tandu sekop' => 'Tandu Sekop',
                        'tenda' => 'Tenda',
                        'tongkat' => 'Tongkat',
                        'tas obat dalam' => 'Tas Obat Dalam',
                        'tas obat luar' => 'Tas Obat Luar',
                        'tas obat dalam dan luar' => 'Tas Obat Dalam dan Luar',
                        'ice pack' => 'Ice Pack',
                        'ice box' => 'Ice Box'
                    ];
                @endphp
                
                @foreach($equipmentList as $value => $label)
                <div class="flex items-center p-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <input 
                        id="equipment-{{ str_replace(' ', '-', $value) }}" 
                        type="checkbox" 
                        name="medical_equipment[]" 
                        value="{{ $value }}" 
                        class="w-4 h-4 text-[#048C6A] bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-[#048C6A] focus:ring-offset-0"
                    >
                    <label 
                        for="equipment-{{ str_replace(' ', '-', $value) }}" 
                        class="ms-3 text-sm font-medium text-gray-900 cursor-pointer hover:text-[#048C6A] transition-colors duration-200 flex-1"
                    >
                        {{ $label }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <x-form-group name="phone" label="Nomor Telepon" placeholder="08xxxxxxxxxx" />
        <x-form-group name="line" label="ID Line" placeholder="@yourlineid" />
        <x-form-group name="organization" label="Organisasi" />
        <x-form-group name="title" label="Judul Acara" />
        <x-form-group name="event_name" label="Nama Kegiatan" />
        <x-form-group name="description" label="Deskripsi Kebutuhan" textarea="true" placeholder="Jelaskan kebutuhan Anda..." />
        <x-form-group name="date" label="Tanggal Pengajuan" type="date" />
        <x-form-group name="start_time" label="Waktu Mulai" type="time" />
        <x-form-group name="end_time" label="Waktu Selesai" type="time" />
        <x-form-group name="location" label="Lokasi" />
        <x-form-group name="note" label="Catatan" textarea="true" placeholder="Silakan isi dengan informasi yang mungkin kami butuhkan." />

        <div class="px-5">
            <button type="submit"
                class="w-full py-3 bg-[#048C6A] hover:bg-[#06D6A0] text-white font-bold rounded-lg shadow-lg transition duration-300 ease-in-out">
                Ajukan Layanan
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.getElementById('type');
        const personWrapper = document.getElementById('person-wrapper');
        const medicalEquipmentWrapper = document.getElementById('medical-equipment-wrapper');

        function toggleInputs() {
            const selectedType = typeSelect.value;
            if (selectedType === 'Pengajuan Jasa') {
                personWrapper.style.display = 'block';
                medicalEquipmentWrapper.classList.add('hidden');
            } else if (selectedType === 'Alat Kesehatan') {
                personWrapper.style.display = 'none';
                medicalEquipmentWrapper.classList.remove('hidden');
            } else {
                personWrapper.style.display = 'none';
                medicalEquipmentWrapper.classList.add('hidden');
            }
        }

        typeSelect.addEventListener('change', toggleInputs);
        toggleInputs(); // Panggil saat halaman dimuat
    });
</script>

@endsection