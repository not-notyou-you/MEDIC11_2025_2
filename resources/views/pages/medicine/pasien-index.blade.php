@extends('layouts.dashboard_template')

@section('content')
<div class="rounded-md border bg-[#effaf5] border-gray-100 m-6 px-0 sm:p-6 shadow-md shadow-black/5">
    
    @if (session()->has('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mx-auto min-h-[400px]">
        <div class="relative right-0 p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-[#144034] text-center mb-2">
                    Data Penanganan Pasien
                </h1>
                <p class="text-center text-lg text-[#144034]">Daftar lengkap penanganan pasien UMN Medical Center</p>
            </div>

            <!-- Info Jumlah Data -->
            <div class="mb-4 text-sm text-gray-600">
                Total: {{ $pasiens->count() }} data pasien
            </div>

            <!-- Tabel Data Pasien -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-[800px]">
                    <thead>
                        <tr class="bg-[#048C6A]">
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left rounded-tl-md border-r-2 border-white/20">No.</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Tanggal</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Nama Pasien</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">NIM</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Jenis Penanganan</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Penanganan Obat</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Keluhan</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left rounded-tr-md">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pasiens as $pasien)
                        <tr class="hover:bg-[#e0f2e9] transition-colors duration-200">
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $loop->iteration }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $pasien->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $pasien->nama }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $pasien->nim ?? '-' }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">
                                    @if(str_contains($pasien->jenis_penanganan, 'P3K'))
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            P3K
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Medis Dasar
                                        </span>
                                    @endif
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] text-[#144034]">
                                    @if($pasien->penanganan_obat)
                                        <span class="inline-block max-w-xs truncate" title="{{ $pasien->penanganan_obat }}">
                                            {{ Str::limit($pasien->penanganan_obat, 30) }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] text-[#144034]">
                                    <span class="inline-block max-w-xs truncate" title="{{ $pasien->keluhan }}">
                                        {{ Str::limit($pasien->keluhan, 30) }}
                                    </span>
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                @if(auth()->check() && auth()->user()->is_admin)
                                <div class="flex items-center space-x-2">
                                    <button type="button" 
                                        class="btn-edit-pasien border-2 border-blue-500 text-blue-500 font-semibold px-3 py-1 rounded text-sm hover:bg-blue-500 hover:text-white transition duration-300"
                                        data-pasien-id="{{ $pasien->id }}"
                                        data-nama="{{ $pasien->nama }}"
                                        data-nim="{{ $pasien->nim ?? '' }}"
                                        data-jurusan="{{ $pasien->jurusan ?? '' }}"
                                        data-keluhan="{{ $pasien->keluhan }}"
                                        data-jenis-penanganan="{{ $pasien->jenis_penanganan }}"
                                        data-catatan-lanjutan="{{ $pasien->catatan_lanjutan ?? '' }}"
                                        data-kecelakaan="{{ $pasien->kecelakaan ?? '' }}">
                                        Edit
                                    </button>
                                    <button type="button" 
                                        class="btn-delete-pasien border-2 border-red-500 text-red-500 font-semibold px-3 py-1 rounded text-sm hover:bg-red-500 hover:text-white transition duration-300"
                                        data-pasien-id="{{ $pasien->id }}">
                                        Hapus
                                    </button>
                                </div>
                                @else
                                <span class="text-[13px] text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="py-8 px-4 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-lg font-semibold text-gray-600">Belum ada data pasien</p>
                                    <p class="text-gray-500 mt-2">Data penanganan pasien akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($pasiens->hasPages())
            <div class="mt-6">
                {{ $pasiens->links('vendor.pagination.tailwind', ['active_color' => '#048C6A']) }}
            </div>
            @endif

            <!-- Tombol Aksi untuk Admin - DIPINDAH KE BAWAH -->
            @if(auth()->check() && auth()->user()->is_admin)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-[#144034] mb-4 text-center">Admin Tools</h3>
                <div class="flex flex-wrap gap-4 justify-center">
                    {{-- Download Button --}}
                    <a href="{{ route('pasien.export') }}" 
                       class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95">
                        Download Excel
                    </a>

                    {{-- Clear Button --}}
                    <form action="{{ route('pasien.clear') }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data pasien?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="border-2 border-red-500 text-red-500 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-red-500 hover:text-white transition duration-300 active:transform active:scale-95">
                            Clear All
                        </button>
                    </form>

                    {{-- Upload Form --}}
                    <form action="{{ route('pasien.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap gap-4 items-center m-0">
                        @csrf
                        <label class="relative cursor-pointer">
                            <input type="file" name="file" accept=".xlsx,.xls" required
                                class="hidden" id="file-upload">
                            <span class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 cursor-pointer inline-block">
                                Choose Excel File
                            </span>
                        </label>
                        <button type="submit" 
                            class="border-2 border-[#048C6A] bg-[#048C6A] text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#037a5a] hover:border-[#037a5a] transition duration-300 active:transform active:scale-95">
                            Upload Excel
                        </button>
                        <span class="text-sm text-gray-600" id="file-name">No file chosen</span>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editPasienModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Data Pasien</h3>
            <form id="editPasienForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama *</label>
                        <input type="text" name="nama" id="edit_nama" required 
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                    </div>
                    <div>
                        <label for="edit_nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" id="edit_nim" 
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                    </div>
                    <div>
                        <label for="edit_jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <input type="text" name="jurusan" id="edit_jurusan" 
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                    </div>
                    <div>
                        <label for="edit_keluhan" class="block text-sm font-medium text-gray-700">Keluhan *</label>
                        <textarea name="keluhan" id="edit_keluhan" required rows="3"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Penanganan *</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_penanganan" value="medis_dasar" id="edit_jenis_medis_dasar" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Medis Dasar</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="jenis_penanganan" value="p3k" id="edit_jenis_p3k" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">P3K</span>
                            </label>
                        </div>
                    </div>
                    <div id="edit_kecelakaan_section" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">Jenis Kecelakaan</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="kecelakaan[]" value="tajam" id="edit_kecelakaan_tajam" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Tajam</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="kecelakaan[]" value="tumpul" id="edit_kecelakaan_tumpul" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Tumpul</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="checkbox" name="kecelakaan[]" value="kendaraan" id="edit_kecelakaan_kendaraan" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Kendaraan</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="edit_catatan_lanjutan" class="block text-sm font-medium text-gray-700">Catatan Lanjutan</label>
                        <textarea name="catatan_lanjutan" id="edit_catatan_lanjutan" rows="3"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="btnBatalEdit" 
                        class="border-2 border-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-50 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" 
                        class="border-2 border-[#048C6A] bg-[#048C6A] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#037a5a] hover:border-[#037a5a] transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div id="deletePasienModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Hapus Data Pasien</h3>
            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus data pasien ini? Tindakan ini tidak dapat dibatalkan.</p>
            <form id="deletePasienForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" id="btnBatalDelete" 
                        class="border-2 border-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-50 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" 
                        class="border-2 border-red-500 bg-red-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-red-600 hover:border-red-600 transition duration-300">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Element references
    const btnBatalEdit = document.getElementById('btnBatalEdit');
    const btnBatalDelete = document.getElementById('btnBatalDelete');
    const editButtons = document.querySelectorAll('.btn-edit-pasien');
    const deleteButtons = document.querySelectorAll('.btn-delete-pasien');
    
    // Modal elements
    const editModal = document.getElementById('editPasienModal');
    const deleteModal = document.getElementById('deletePasienModal');
    const editForm = document.getElementById('editPasienForm');
    const deleteForm = document.getElementById('deletePasienForm');

    // File upload handler
    const fileUpload = document.getElementById('file-upload');
    const fileName = document.getElementById('file-name');
    
    if (fileUpload) {
        fileUpload.addEventListener('change', function(e) {
            const fileNameText = e.target.files.length ? e.target.files[0].name : 'No file chosen';
            fileName.textContent = fileNameText;
        });
    }

    // Fungsi untuk menampilkan modal
    function openModal(modalElement) {
        modalElement.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup modal
    function closeModal(modalElement) {
        modalElement.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Event Listeners
    btnBatalEdit.addEventListener('click', function() {
        closeModal(editModal);
    });

    btnBatalDelete.addEventListener('click', function() {
        closeModal(deleteModal);
    });

    // Event listeners untuk tombol edit
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pasienId = this.getAttribute('data-pasien-id');
            const nama = this.getAttribute('data-nama');
            const nim = this.getAttribute('data-nim');
            const jurusan = this.getAttribute('data-jurusan');
            const keluhan = this.getAttribute('data-keluhan');
            const jenisPenanganan = this.getAttribute('data-jenis-penanganan');
            const catatanLanjutan = this.getAttribute('data-catatan-lanjutan');
            const kecelakaan = this.getAttribute('data-kecelakaan');

            // Isi form edit dengan data pasien
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_nim').value = nim;
            document.getElementById('edit_jurusan').value = jurusan;
            document.getElementById('edit_keluhan').value = keluhan;
            document.getElementById('edit_catatan_lanjutan').value = catatanLanjutan;
            
            // Handle jenis penanganan
            const kecelakaanSection = document.getElementById('edit_kecelakaan_section');
            if (jenisPenanganan.includes('P3K')) {
                document.getElementById('edit_jenis_p3k').checked = true;
                kecelakaanSection.style.display = 'block';
                
                // Reset semua checkbox kecelakaan
                document.getElementById('edit_kecelakaan_tajam').checked = false;
                document.getElementById('edit_kecelakaan_tumpul').checked = false;
                document.getElementById('edit_kecelakaan_kendaraan').checked = false;
                
                // Set checkbox berdasarkan data
                if (kecelakaan) {
                    const kecelakaanArray = kecelakaan.split(', ');
                    kecelakaanArray.forEach(k => {
                        if (k === 'tajam') document.getElementById('edit_kecelakaan_tajam').checked = true;
                        if (k === 'tumpul') document.getElementById('edit_kecelakaan_tumpul').checked = true;
                        if (k === 'kendaraan') document.getElementById('edit_kecelakaan_kendaraan').checked = true;
                    });
                }
            } else {
                document.getElementById('edit_jenis_medis_dasar').checked = true;
                kecelakaanSection.style.display = 'none';
            }

            // Set action form edit
            editForm.action = '/pasien/' + pasienId;

            // Tampilkan modal edit
            openModal(editModal);
        });
    });

    // Event listeners untuk tombol delete
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pasienId = this.getAttribute('data-pasien-id');

            // Set action form delete
            deleteForm.action = '/pasien/' + pasienId;

            // Tampilkan modal delete
            openModal(deleteModal);
        });
    });

    // Handle change jenis penanganan di modal edit
    document.querySelectorAll('input[name="jenis_penanganan"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const kecelakaanSection = document.getElementById('edit_kecelakaan_section');
            if (this.value === 'p3k') {
                kecelakaanSection.style.display = 'block';
            } else {
                kecelakaanSection.style.display = 'none';
            }
        });
    });

    // Tutup modal ketika klik di luar
    window.addEventListener('click', function(event) {
        if (event.target === editModal) {
            closeModal(editModal);
        }
        if (event.target === deleteModal) {
            closeModal(deleteModal);
        }
    });

    // Handle escape key to close modals
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal(editModal);
            closeModal(deleteModal);
        }
    });
});
</script>
@endpush