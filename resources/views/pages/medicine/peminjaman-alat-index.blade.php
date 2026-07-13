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
                    Daftar Peminjaman Alat Kesehatan
                </h1>
                <p class="text-center text-lg text-[#144034]">Manajemen peminjaman alat kesehatan UMN Medical Center</p>
            </div>

            <!-- Tombol Tambah Peminjaman -->
            <div class="mb-6 flex justify-center">
                <button type="button" id="btnTambahPeminjaman" 
                    class="border-2 border-[#048C6A] bg-[#048C6A] text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-[#037a5a] hover:border-[#037a5a] transition duration-300 active:transform active:scale-95">
                    + Tambah Peminjaman Alat
                </button>
            </div>

            <!-- Info Jumlah Data -->
            <div class="mb-4 text-sm text-gray-600">
                Total: {{ $peminjamanAlats->count() }} data peminjaman
            </div>

            <!-- Tabel Data Peminjaman -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-[800px]">
                    <thead>
                        <tr class="bg-[#048C6A]">
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left rounded-tl-md border-r-2 border-white/20">No.</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Nama Peminjam</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">NIM</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Barang Dipinjam</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Lama (hari)</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Status</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left rounded-tr-md">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamanAlats as $peminjaman)
                        <tr class="hover:bg-[#e0f2e9] transition-colors duration-200">
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $loop->iteration }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $peminjaman->nama_peminjam }}</span>
                                <br>
                                <span class="text-[11px] text-gray-500">{{ $peminjaman->email_nomor_hp }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $peminjaman->nim_peminjam }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] text-[#144034]">
                                    <span class="inline-block max-w-xs truncate" title="{{ $peminjaman->barang_dipinjam }}">
                                        {{ Str::limit($peminjaman->barang_dipinjam, 25) }}
                                    </span>
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $peminjaman->lama_peminjaman }} hari</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                @if($peminjaman->status)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Sudah Dikembalikan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Masih Dipinjam
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                @if(auth()->check() && auth()->user()->is_admin)
                                <div class="flex items-center space-x-2">
                                    <button type="button" 
                                        class="btn-edit-peminjaman border-2 border-blue-500 text-blue-500 font-semibold px-3 py-1 rounded text-sm hover:bg-blue-500 hover:text-white transition duration-300"
                                        data-peminjaman-id="{{ $peminjaman->id }}"
                                        data-email-nomor-hp="{{ $peminjaman->email_nomor_hp }}"
                                        data-nama-peminjam="{{ $peminjaman->nama_peminjam }}"
                                        data-nim-peminjam="{{ $peminjaman->nim_peminjam }}"
                                        data-barang-dipinjam="{{ $peminjaman->barang_dipinjam }}"
                                        data-lama-peminjaman="{{ $peminjaman->lama_peminjaman }}"
                                        data-status="{{ $peminjaman->status ? '1' : '0' }}"
                                        data-catatan-tambahan="{{ $peminjaman->catatan_tambahan ?? '' }}">
                                        Edit
                                    </button>
                                    @if($peminjaman->status)
                                    <form action="{{ route('peminjaman-alat.destroy', $peminjaman->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="border-2 border-red-500 text-red-500 font-semibold px-3 py-1 rounded text-sm hover:bg-red-500 hover:text-white transition duration-300"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                @else
                                <span class="text-[13px] text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <p class="text-lg font-semibold text-gray-600">Belum ada data peminjaman</p>
                                    <p class="text-gray-500 mt-2">Data peminjaman alat akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($peminjamanAlats->hasPages())
            <div class="mt-6">
                {{ $peminjamanAlats->links('vendor.pagination.tailwind', ['active_color' => '#048C6A']) }}
            </div>
            @endif

            <!-- Tombol Aksi untuk Admin - DI BAWAH TABEL -->
            @if(auth()->check() && auth()->user()->is_admin)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-[#144034] mb-4 text-center">Admin Tools</h3>
                <div class="flex flex-wrap gap-4 justify-center">
                    {{-- Download Button --}}
                    <a href="{{ route('peminjaman-alat.export') }}" 
                       class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95">
                        Download Excel
                    </a>

                    {{-- Clear Button --}}
                    <form action="{{ route('peminjaman-alat.clear') }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data peminjaman?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="border-2 border-red-500 text-red-500 font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-red-500 hover:text-white transition duration-300 active:transform active:scale-95">
                            Clear All
                        </button>
                    </form>

                    {{-- Upload Form --}}
                    <form action="{{ route('peminjaman-alat.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap gap-4 items-center m-0">
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

<!-- Modal Create -->
<div id="createPeminjamanAlatModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-4 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Peminjaman Alat</h3>
            <form action="{{ route('peminjaman-alat.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Kolom 1 -->
                    <div class="space-y-4">
                        <div>
                            <label for="email_nomor_hp" class="block text-sm font-medium text-gray-700">Email/Nomor HP *</label>
                            <input type="text" name="email_nomor_hp" id="email_nomor_hp" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                        <div>
                            <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam *</label>
                            <input type="text" name="nama_peminjam" id="nama_peminjam" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="space-y-4">
                        <div>
                            <label for="nim_peminjam" class="block text-sm font-medium text-gray-700">NIM Peminjam *</label>
                            <input type="text" name="nim_peminjam" id="nim_peminjam" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                        <div>
                            <label for="lama_peminjaman" class="block text-sm font-medium text-gray-700">Lama Peminjaman (hari) *</label>
                            <input type="number" name="lama_peminjaman" id="lama_peminjaman" required min="1" 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                    </div>

                    <!-- Kolom 3 -->
                    <div class="space-y-4">
                        <div>
                            <label for="barang_dipinjam" class="block text-sm font-medium text-gray-700">Barang yang Dipinjam *</label>
                            <select name="barang_dipinjam" id="barang_dipinjam" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                                <option value="">Pilih Barang</option>
                                <option value="Kursi Roda">Kursi Roda</option>
                                <option value="Tongkat (Kruk)">Tongkat (Kruk)</option>
                                <option value="Heat Pack">Heat Pack</option>
                                <option value="Ice Pack">Ice Pack</option>
                                <option value="Ice Box">Ice Box</option>
                                <option value="Oxican">Oxican</option>
                                <option value="Tabung Oksigen">Tabung Oksigen</option>
                                <option value="OTHER">OTHER (Lainnya)</option>
                            </select>
                        </div>
                        <div id="other_barang_container" style="display: none;">
                            <label for="other_barang" class="block text-sm font-medium text-gray-700">Nama Barang Lainnya *</label>
                            <input type="text" name="other_barang" id="other_barang" 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                    </div>
                </div>

                <!-- Baris 2 - Full Width -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="1" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Sudah Dikembalikan</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="status" value="0" checked class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Masih Dipinjam</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="catatan_tambahan" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                        <textarea name="catatan_tambahan" id="catatan_tambahan" rows="3"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="btnBatalCreate" 
                        class="border-2 border-gray-300 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-50 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" 
                        class="border-2 border-[#048C6A] bg-[#048C6A] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#037a5a] hover:border-[#037a5a] transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editPeminjamanAlatModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-4 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Peminjaman Alat</h3>
            <form id="editPeminjamanAlatForm" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Kolom 1 -->
                    <div class="space-y-4">
                        <div>
                            <label for="edit_email_nomor_hp" class="block text-sm font-medium text-gray-700">Email/Nomor HP *</label>
                            <input type="text" name="email_nomor_hp" id="edit_email_nomor_hp" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                        <div>
                            <label for="edit_nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam *</label>
                            <input type="text" name="nama_peminjam" id="edit_nama_peminjam" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                    </div>

                    <!-- Kolom 2 -->
                    <div class="space-y-4">
                        <div>
                            <label for="edit_nim_peminjam" class="block text-sm font-medium text-gray-700">NIM Peminjam *</label>
                            <input type="text" name="nim_peminjam" id="edit_nim_peminjam" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                        <div>
                            <label for="edit_lama_peminjaman" class="block text-sm font-medium text-gray-700">Lama Peminjaman (hari) *</label>
                            <input type="number" name="lama_peminjaman" id="edit_lama_peminjaman" required min="1" 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                    </div>

                    <!-- Kolom 3 -->
                    <div class="space-y-4">
                        <div>
                            <label for="edit_barang_dipinjam" class="block text-sm font-medium text-gray-700">Barang yang Dipinjam *</label>
                            <select name="barang_dipinjam" id="edit_barang_dipinjam" required 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                                <option value="">Pilih Barang</option>
                                <option value="Kursi Roda">Kursi Roda</option>
                                <option value="Tongkat (Kruk)">Tongkat (Kruk)</option>
                                <option value="Heat Pack">Heat Pack</option>
                                <option value="Ice Pack">Ice Pack</option>
                                <option value="Ice Box">Ice Box</option>
                                <option value="Oxican">Oxican</option>
                                <option value="Tabung Oksigen">Tabung Oksigen</option>
                                <option value="OTHER">OTHER (Lainnya)</option>
                            </select>
                        </div>
                        <div id="edit_other_barang_container" style="display: none;">
                            <label for="edit_other_barang" class="block text-sm font-medium text-gray-700">Nama Barang Lainnya *</label>
                            <input type="text" name="other_barang" id="edit_other_barang" 
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                        </div>
                    </div>
                </div>

                <!-- Baris 2 - Full Width -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="1" id="edit_status_sudah" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Sudah Dikembalikan</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="status" value="0" id="edit_status_belum" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Masih Dipinjam</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="edit_catatan_tambahan" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                        <textarea name="catatan_tambahan" id="edit_catatan_tambahan" rows="3"
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Element references
    const btnTambahPeminjaman = document.getElementById('btnTambahPeminjaman');
    const btnBatalCreate = document.getElementById('btnBatalCreate');
    const btnBatalEdit = document.getElementById('btnBatalEdit');
    const editButtons = document.querySelectorAll('.btn-edit-peminjaman');
    
    // Modal elements
    const createModal = document.getElementById('createPeminjamanAlatModal');
    const editModal = document.getElementById('editPeminjamanAlatModal');
    const editForm = document.getElementById('editPeminjamanAlatForm');

    // Dropdown elements
    const barangDipinjam = document.getElementById('barang_dipinjam');
    const otherBarangContainer = document.getElementById('other_barang_container');
    const otherBarangInput = document.getElementById('other_barang');
    
    const editBarangDipinjam = document.getElementById('edit_barang_dipinjam');
    const editOtherBarangContainer = document.getElementById('edit_other_barang_container');
    const editOtherBarangInput = document.getElementById('edit_other_barang');

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

    // Handle dropdown barang dipinjam
    function handleBarangDipinjamChange(selectElement, containerElement, inputElement) {
        if (selectElement.value === 'OTHER') {
            containerElement.style.display = 'block';
            inputElement.required = true;
        } else {
            containerElement.style.display = 'none';
            inputElement.required = false;
            inputElement.value = '';
        }
    }

    // Event Listeners untuk dropdown
    barangDipinjam.addEventListener('change', function() {
        handleBarangDipinjamChange(this, otherBarangContainer, otherBarangInput);
    });

    editBarangDipinjam.addEventListener('change', function() {
        handleBarangDipinjamChange(this, editOtherBarangContainer, editOtherBarangInput);
    });

    // Event Listeners untuk modal
    btnTambahPeminjaman.addEventListener('click', function() {
        openModal(createModal);
    });

    btnBatalCreate.addEventListener('click', function() {
        closeModal(createModal);
    });

    btnBatalEdit.addEventListener('click', function() {
        closeModal(editModal);
    });

    // Event listeners untuk tombol edit
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const peminjamanId = this.getAttribute('data-peminjaman-id');
            const emailNomorHp = this.getAttribute('data-email-nomor-hp');
            const namaPeminjam = this.getAttribute('data-nama-peminjam');
            const nimPeminjam = this.getAttribute('data-nim-peminjam');
            const barangDipinjamValue = this.getAttribute('data-barang-dipinjam');
            const lamaPeminjaman = this.getAttribute('data-lama-peminjaman');
            const status = this.getAttribute('data-status');
            const catatanTambahan = this.getAttribute('data-catatan-tambahan');

            // Isi form edit dengan data
            document.getElementById('edit_email_nomor_hp').value = emailNomorHp;
            document.getElementById('edit_nama_peminjam').value = namaPeminjam;
            document.getElementById('edit_nim_peminjam').value = nimPeminjam;
            document.getElementById('edit_lama_peminjaman').value = lamaPeminjaman;
            document.getElementById('edit_catatan_tambahan').value = catatanTambahan;
            
            // Handle barang dipinjam
            const isOther = ![
                'Kursi Roda', 'Tongkat (Kruk)', 'Heat Pack', 'Ice Pack', 
                'Ice Box', 'Oxican', 'Tabung Oksigen'
            ].includes(barangDipinjamValue);
            
            if (isOther) {
                document.getElementById('edit_barang_dipinjam').value = 'OTHER';
                editOtherBarangContainer.style.display = 'block';
                editOtherBarangInput.value = barangDipinjamValue;
                editOtherBarangInput.required = true;
            } else {
                document.getElementById('edit_barang_dipinjam').value = barangDipinjamValue;
                editOtherBarangContainer.style.display = 'none';
                editOtherBarangInput.required = false;
            }

            // Handle status
            if (status === '1') {
                document.getElementById('edit_status_sudah').checked = true;
            } else {
                document.getElementById('edit_status_belum').checked = true;
            }

            // Set action form
            editForm.action = '/peminjaman-alat/' + peminjamanId;

            // Tampilkan modal
            openModal(editModal);
        });
    });

    // Tutup modal ketika klik di luar
    window.addEventListener('click', function(event) {
        if (event.target === createModal) {
            closeModal(createModal);
        }
        if (event.target === editModal) {
            closeModal(editModal);
        }
    });

    // Handle escape key to close modals
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal(createModal);
            closeModal(editModal);
        }
    });
});
</script>
@endpush