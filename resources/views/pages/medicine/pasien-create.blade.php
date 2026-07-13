@extends('layouts.dashboard_template')

@section('content')
<!-- Modal Info Obat -->
<div id="infoObatModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900" id="modalObatTitle">Informasi Obat</h3>
            <div class="mt-2" id="modalObatContent">
                <!-- Content will be filled by JavaScript -->
            </div>
            <div class="mt-4 flex justify-end">
                <button type="button" onclick="closeInfoModal()" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Persetujuan -->
<div id="consentModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 mb-4">
                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.882 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Persetujuan Pasien</h3>
            <div class="mt-2 px-2 py-1 text-center">
                <p class="text-sm text-gray-600 mb-4">
                    Apakah pasien bersedia untuk didata dalam sistem kami? 
                    Data akan digunakan untuk keperluan medis dan statistik.
                </p>
            </div>
            <div class="mt-4 flex justify-center space-x-4">
                <button type="button" onclick="setConsent(false)" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded transition duration-300">
                    Tidak
                </button>
                <button type="button" onclick="setConsent(true)" 
                    class="bg-[#048C6A] hover:bg-[#036952] text-white font-bold py-2 px-6 rounded transition duration-300">
                    Ya, Setuju
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Container -->
<div id="notificationContainer" class="fixed top-4 right-4 z-50 space-y-2">
    @if(session('success'))
    <div class="notification bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-center justify-between max-w-md">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="ml-4 text-green-700 hover:text-green-900">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="notification bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg flex items-center justify-between max-w-md">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="ml-4 text-red-700 hover:text-red-900">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="notification bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-md">
        <div class="flex items-center mb-2">
            <svg class="h-5 w-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="font-semibold">Terjadi kesalahan:</span>
        </div>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-700 hover:text-red-900">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
    @endif
</div>

<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <h1 class="text-2xl font-semibold text-[#144034] text-center mb-2">
            Form Pendataan Pasien
        </h1>
        <p class="text-center text-lg text-[#144034]">Isi data pasien dengan lengkap dan benar</p>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        <form id="patientForm" action="{{ route('pasien.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="persetujuan" id="persetujuan" value="0">

            <!-- Nama, NIM, Jurusan -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="relative z-0 w-full group">
                    <input type="text" name="nama" id="nama" required
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#048C6A] peer"
                        placeholder=" " />
                    <label for="nama"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#048C6A] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama Lengkap</label>
                </div>

                <div class="relative z-0 w-full group">
                    <input type="text" name="nim" id="nim"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#048C6A] peer"
                        placeholder=" " />
                    <label for="nim"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#048C6A] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">NIM</label>
                </div>

                <div class="relative z-0 w-full group">
                    <select name="jurusan" id="jurusan-select" required
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#048C6A] peer">
                        <option value="">Pilih Jurusan</option>
                        <option value="Informatika (S1)">Informatika (S1)</option>
                        <option value="Teknik Komputer (S1)">Teknik Komputer (S1)</option>
                        <option value="Teknik Elektro (S1)">Teknik Elektro (S1)</option>
                        <option value="Teknik Fisika (S1)">Teknik Fisika (S1)</option>
                        <option value="Sistem Informasi (S1)">Sistem Informasi (S1)</option>
                        <option value="Gelar Bersama – Program Informatika">Gelar Bersama – Program Informatika</option>
                        <option value="Perhotelan (D3)">Perhotelan (D3)</option>
                        <option value="Akuntansi (S1)">Akuntansi (S1)</option>
                        <option value="Managemen (S1)">Managemen (S1)</option>
                        <option value="Magister Managemen Teknologi (S2)">Magister Managemen Teknologi (S2)</option>
                        <option value="Komunikasi Strategis (S1)">Komunikasi Strategis (S1)</option>
                        <option value="Jurnalistik (S1)">Jurnalistik (S1)</option>
                        <option value="Magister Ilmu Komunikasi (S2)">Magister Ilmu Komunikasi (S2)</option>
                        <option value="Desain Komunikasi Visual (S1)">Desain Komunikasi Visual (S1)</option>
                        <option value="Arsitektur (S1)">Arsitektur (S1)</option>
                        <option value="Film & Animasi (S1)">Film & Animasi (S1)</option>
                        <option value="non mahasiswa (dosen)">non mahasiswa (dosen)</option>
                        <option value="non mahasiswa (security)">non mahasiswa (security)</option>
                        <option value="non mahasiswa (staff)">non mahasiswa (staff)</option>
                        <option value="non mahasiswa (eksternal)">non mahasiswa (eksternal)</option>
                        <option value="other">Other (Lainnya)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <label for="jurusan-select"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#048C6A] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jurusan</label>
                </div>
            </div>

            <input type="text" name="jurusan_custom" id="jurusan-custom" 
                placeholder="Ketik jurusan lainnya..." 
                class="hidden w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">

            <!-- Keluhan -->
            <div class="mb-6">
                <label for="keluhan" class="block text-sm font-medium text-[#144034] mb-3">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="4" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
            </div>

            <!-- Jenis Penanganan -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-[#144034] mb-3">Jenis Penanganan</label>
                <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-3 sm:space-y-0">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_penanganan" value="medis_dasar" class="jenis-penanganan sr-only peer" checked>
                        <span class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-[#048C6A] peer-checked:bg-[#048C6A] mr-3 relative">
                            <span class="absolute inset-1 bg-white rounded-full peer-checked:bg-[#048C6A]"></span>
                        </span>
                        <span class="text-sm font-medium text-[#144034]">Medis Dasar</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_penanganan" value="p3k" class="jenis-penanganan sr-only peer">
                        <span class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-[#048C6A] peer-checked:bg-[#048C6A] mr-3 relative">
                            <span class="absolute inset-1 bg-white rounded-full peer-checked:bg-[#048C6A]"></span>
                        </span>
                        <span class="text-sm font-medium text-[#144034]">P3K</span>
                    </label>
                </div>
            </div>

            <!-- Obat Minum Section -->
            <div id="obat-minum-section" class="mb-6">
                <h3 class="text-lg font-semibold text-[#144034] mb-4">Obat Minum</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
                    @foreach($obatMinums as $obat)
                    <div class="group relative border border-gray-200 rounded-lg p-3 hover:border-[#048C6A] hover:shadow-md transition-all duration-200 bg-white">
                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-3 cursor-pointer flex-1">
                                <input type="checkbox" name="penanganan_obat[obat_minum][{{ $obat->id }}][obat_id]" 
                                    value="{{ $obat->id }}" class="obat-checkbox absolute opacity-0">
                                <span class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center checkbox-custom group-hover:border-[#048C6A] transition-colors">
                                    <svg class="hidden w-3 h-3 text-white fill-current" viewBox="0 0 20 20">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                                    </svg>
                                </span>
                                <span class="text-sm font-medium text-[#144034] group-hover:text-[#048C6A] transition-colors">{{ $obat->nama_obat }}</span>
                            </label>
                            <button type="button" class="info-obat-btn text-gray-400 hover:text-[#048C6A] ml-2 transition-colors" 
                                data-obat-id="{{ $obat->id }}" 
                                data-obat-type="minum"
                                data-nama-obat="{{ $obat->nama_obat }}"
                                data-dosis="{{ $obat->dosis }}"
                                data-ketentuan="{{ $obat->ketentuan }}"
                                data-komposisi="{{ $obat->komposisi }}">
                                <i class="ri-information-line text-lg"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between mt-3 jumlah-container" style="display: none;">
                            <span class="text-xs text-gray-500 font-medium">Jumlah:</span>
                            <input type="number" name="penanganan_obat[obat_minum][{{ $obat->id }}][jumlah]" 
                                value="1" min="1" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-[#048C6A]">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Obat Luar Section -->
            <div id="obat-luar-section" class="mb-6" style="display: none;">
                <h3 class="text-lg font-semibold text-[#144034] mb-4">Obat Luar</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
                    @foreach($obatLuars as $obat)
                    <div class="group relative border border-gray-200 rounded-lg p-3 hover:border-[#048C6A] hover:shadow-md transition-all duration-200 bg-white">
                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-3 cursor-pointer flex-1">
                                <input type="checkbox" name="penanganan_obat[obat_luar][{{ $obat->id }}][obat_id]" 
                                    value="{{ $obat->id }}" class="obat-checkbox absolute opacity-0">
                                <span class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center checkbox-custom group-hover:border-[#048C6A] transition-colors">
                                    <svg class="hidden w-3 h-3 text-white fill-current" viewBox="0 0 20 20">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                                    </svg>
                                </span>
                                <span class="text-sm font-medium text-[#144034] group-hover:text-[#048C6A] transition-colors">{{ $obat->nama_obat }}</span>
                            </label>
                            <button type="button" class="info-obat-btn text-gray-400 hover:text-[#048C6A] ml-2 transition-colors" 
                                data-obat-id="{{ $obat->id }}" 
                                data-obat-type="luar"
                                data-nama-obat="{{ $obat->nama_obat }}"
                                data-ketentuan="{{ $obat->ketentuan }}">
                                <i class="ri-information-line text-lg"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between mt-3 jumlah-container" style="display: none;">
                            <span class="text-xs text-gray-500 font-medium">Jumlah:</span>
                            <input type="number" name="penanganan_obat[obat_luar][{{ $obat->id }}][jumlah]" 
                                value="1" min="1" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-[#048C6A]">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Kecelakaan Section -->
            <div id="kecelakaan-section" class="mb-6" style="display: none;">
                <h3 class="text-lg font-semibold text-[#144034] mb-4">Jenis Kecelakaan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                        <input type="checkbox" name="kecelakaan[]" value="tajam" class="hidden">
                        <span class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center checkbox-custom">
                            <svg class="hidden w-3 h-3 text-white fill-current" viewBox="0 0 20 20">
                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-[#144034]">Tajam</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                        <input type="checkbox" name="kecelakaan[]" value="tumpul" class="hidden">
                        <span class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center checkbox-custom">
                            <svg class="hidden w-3 h-3 text-white fill-current" viewBox="0 0 20 20">
                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-[#144034]">Tumpul</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                        <input type="checkbox" name="kecelakaan[]" value="kendaraan" class="hidden">
                        <span class="w-5 h-5 border-2 border-gray-300 rounded flex items-center justify-center checkbox-custom">
                            <svg class="hidden w-3 h-3 text-white fill-current" viewBox="0 0 20 20">
                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-medium text-[#144034]">Kendaraan</span>
                    </label>
                </div>
            </div>

            <!-- Catatan Lanjutan -->
            <div class="mb-6">
                <label for="catatan_lanjutan" class="block text-sm font-medium text-[#144034] mb-3">Catatan Lanjutan (Opsional)</label>
                <textarea name="catatan_lanjutan" id="catatan_lanjutan" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" id="submitButton"
                    class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.checkbox-custom {
    transition: all 0.2s ease-in-out;
}
.checkbox-custom.checked {
    background-color: #048C6A;
    border-color: #048C6A;
}

/* Custom radio button */
input[type="radio"]:checked + span > span {
    background-color: #048C6A;
}

/* Ensure dropdown opens downward */
select {
    z-index: 10;
}

/* Notification animations */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

.notification {
    animation: slideIn 0.3s ease-out;
}

.notification.fading {
    animation: fadeOut 0.5s ease-out;
}

#notificationContainer {
    top: 80px !important;
}
</style>

<script>
    function setConsent(accepted) {
        if (accepted) {
            document.getElementById('persetujuan').value = '1';
            document.getElementById('consentModal').classList.add('hidden');
            // Submit form setelah persetujuan diberikan
            document.getElementById('patientForm').submit();
        } else {
            document.getElementById('consentModal').classList.add('hidden');
            // Tampilkan notifikasi bahwa pasien tidak bersedia
            showNotification('Data tidak dapat disimpan karena pasien tidak bersedia didata.', 'error');
        }
    }

    function openInfoModal() {
        document.getElementById('infoObatModal').classList.remove('hidden');
    }

    function closeInfoModal() {
        document.getElementById('infoObatModal').classList.add('hidden');
    }

    function showNotification(message, type = 'success') {
        const container = document.getElementById('notificationContainer');
        const notification = document.createElement('div');
        
        const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 
                       type === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 
                       'bg-yellow-100 border-yellow-400 text-yellow-700';
        
        const icon = type === 'success' ? 
            '<svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>' :
            '<svg class="h-5 w-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>';
        
        notification.className = `notification ${bgColor} px-4 py-3 rounded-lg shadow-lg flex items-center justify-between max-w-md mb-2`;
        notification.innerHTML = `
            <div class="flex items-center">
                ${icon}
                <span>${message}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="ml-4 ${type === 'success' ? 'text-green-700 hover:text-green-900' : 'text-red-700 hover:text-red-900'}">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        `;
        
        container.appendChild(notification);
        
        // Auto remove notification after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.classList.add('fading');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 500);
            }
        }, 5000);
    }

    // Handle form submission
    document.getElementById('patientForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi form sebelum menampilkan modal persetujuan
        const nama = document.getElementById('nama').value.trim();
        const keluhan = document.getElementById('keluhan').value.trim();
        
        if (!nama || !keluhan) {
            showNotification('Harap isi nama dan keluhan terlebih dahulu.', 'error');
            return;
        }
        
        // Tampilkan modal persetujuan
        document.getElementById('consentModal').classList.remove('hidden');
    });

    // Handle jenis penanganan change
    document.querySelectorAll('.jenis-penanganan').forEach(radio => {
        radio.addEventListener('change', function() {
            const isP3K = this.value === 'p3k';
            
            document.getElementById('obat-minum-section').style.display = isP3K ? 'none' : 'block';
            document.getElementById('obat-luar-section').style.display = isP3K ? 'block' : 'none';
            document.getElementById('kecelakaan-section').style.display = isP3K ? 'block' : 'none';
        });
    });

    // Handle dropdown jurusan
    document.addEventListener('DOMContentLoaded', function() {
        const jurusanSelect = document.getElementById('jurusan-select');
        const jurusanCustom = document.getElementById('jurusan-custom');

        jurusanSelect.addEventListener('change', function() {
            if (this.value === 'other') {
                jurusanCustom.classList.remove('hidden');
                jurusanCustom.required = true;
            } else {
                jurusanCustom.classList.add('hidden');
                jurusanCustom.required = false;
                jurusanCustom.value = '';
            }
        });

        // Checkbox untuk obat
        document.querySelectorAll('.obat-checkbox').forEach(checkbox => {
            const container = checkbox.closest('label');
            const customCheckbox = container.querySelector('.checkbox-custom');
            const jumlahContainer = container.closest('.group').querySelector('.jumlah-container');

            container.addEventListener('click', function(e) {
                if (e.target.type !== 'number') {
                    checkbox.checked = !checkbox.checked;
                    if (checkbox.checked) {
                        customCheckbox.classList.add('checked');
                        customCheckbox.querySelector('svg').classList.remove('hidden');
                        jumlahContainer.style.display = 'flex';
                    } else {
                        customCheckbox.classList.remove('checked');
                        customCheckbox.querySelector('svg').classList.add('hidden');
                        jumlahContainer.style.display = 'none';
                    }
                }
            });
        });

        // Checkbox untuk kecelakaan
        document.querySelectorAll('input[name="kecelakaan[]"]').forEach(checkbox => {
            const container = checkbox.closest('label');
            const customCheckbox = container.querySelector('.checkbox-custom');

            container.addEventListener('click', function() {
                checkbox.checked = !checkbox.checked;
                if (checkbox.checked) {
                    customCheckbox.classList.add('checked');
                    customCheckbox.querySelector('svg').classList.remove('hidden');
                } else {
                    customCheckbox.classList.remove('checked');
                    customCheckbox.querySelector('svg').classList.add('hidden');
                }
            });
        });

        // Modal info obat
        document.querySelectorAll('.info-obat-btn').forEach(button => {
            button.addEventListener('click', function() {
                const namaObat = this.getAttribute('data-nama-obat');
                const dosis = this.getAttribute('data-dosis');
                const ketentuan = this.getAttribute('data-ketentuan');
                const komposisi = this.getAttribute('data-komposisi');
                const obatType = this.getAttribute('data-obat-type');

                document.getElementById('modalObatTitle').textContent = `Informasi ${namaObat}`;
                
                let content = `
                    <div class="space-y-3">
                        <div>
                            <strong class="text-gray-700">Nama Obat:</strong>
                            <p class="mt-1">${namaObat}</p>
                        </div>
                `;

                if (obatType === 'minum') {
                    content += `
                        <div>
                            <strong class="text-gray-700">Dosis:</strong>
                            <p class="mt-1">${dosis}</p>
                        </div>
                        <div>
                            <strong class="text-gray-700">Komposisi:</strong>
                            <p class="mt-1">${komposisi}</p>
                        </div>
                    `;
                }

                content += `
                        <div>
                            <strong class="text-gray-700">Ketentuan:</strong>
                            <p class="mt-1 text-sm">${ketentuan}</p>
                        </div>
                    </div>
                `;

                document.getElementById('modalObatContent').innerHTML = content;
                openInfoModal();
            });
        });

        // Auto remove session notifications after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('#notificationContainer .notification').forEach(notification => {
                notification.classList.add('fading');
                setTimeout(() => {
                    notification.remove();
                }, 500);
            });
        }, 5000);
    });

    // Tutup modal ketika klik di luar
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('infoObatModal');
        const consentModal = document.getElementById('consentModal');
        
        if (event.target === modal) {
            closeInfoModal();
        }
        if (event.target === consentModal) {
            consentModal.classList.add('hidden');
        }
    });
</script>
@endsection