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
                    Daftar Obat Luar
                </h1>
                <p class="text-center text-lg text-[#144034]">Manajemen data obat luar UMN Medical Center</p>
            </div>

            <!-- Tombol Tambah untuk Admin -->
            @if(auth()->check() && auth()->user()->is_admin)
            <div class="mb-6 flex justify-center">
                <button type="button" id="btnTambahObat" 
                    class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                    + Tambah Obat Luar
                </button>
            </div>
            @endif

            <!-- Info Jumlah Data -->
            <div class="mb-4 text-sm text-gray-600">
                Total: {{ $obatLuars->count() }} obat luar
            </div>

            <!-- Tabel Data Obat Luar -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-[800px]">
                    <thead>
                        <tr class="bg-[#048C6A]">
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left rounded-tl-md border-r-2 border-white/20">No.</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Nama Obat</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Ketentuan</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left border-r-2 border-white/20">Status</th>
                            <th class="text-[12px] uppercase tracking-wide font-semibold text-white py-3 px-4 text-left rounded-tr-md">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($obatLuars as $obat)
                        <tr class="hover:bg-[#e0f2e9] transition-colors duration-200">
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $loop->iteration }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] font-semibold text-[#144034]">{{ $obat->nama_obat }}</span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                <span class="text-[13px] text-[#144034]">
                                    <span class="inline-block max-w-xs truncate" title="{{ $obat->ketentuan }}">
                                        {{ Str::limit($obat->ketentuan, 50) }}
                                    </span>
                                </span>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                @if($obat->status)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200">
                                @if(auth()->check() && auth()->user()->is_admin)
                                <div class="flex items-center space-x-2">
                                    <button type="button" 
                                        class="btn-edit-obat border-2 border-blue-500 text-blue-500 font-semibold px-3 py-1 rounded text-sm hover:bg-blue-500 hover:text-white transition duration-300"
                                        data-obat-id="{{ $obat->id }}"
                                        data-nama-obat="{{ $obat->nama_obat }}"
                                        data-ketentuan="{{ $obat->ketentuan }}"
                                        data-status="{{ $obat->status ? '1' : '0' }}">
                                        Edit
                                    </button>
                                    @if(!$obat->status)
                                    <form action="{{ route('obat-luar.destroy', $obat->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="border-2 border-red-500 text-red-500 font-semibold px-3 py-1 rounded text-sm hover:bg-red-500 hover:text-white transition duration-300"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
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
                            <td colspan="5" class="py-8 px-4 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-lg font-semibold text-gray-600">Belum ada data obat luar</p>
                                    <p class="text-gray-500 mt-2">Data obat luar akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination - HAPUS BAGIAN INI JIKA TIDAK PAKAI PAGINATION -->
            {{-- 
            @if($obatLuars->hasPages())
            <div class="mt-6">
                {{ $obatLuars->links('vendor.pagination.tailwind', ['active_color' => '#048C6A']) }}
            </div>
            @endif 
            --}}
        </div>
    </div>
</div>

<!-- Modal Create -->
<div id="createObatLuarModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Obat Luar</h3>
            <form action="{{ route('obat-luar.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama_obat" class="block text-sm font-medium text-gray-700">Nama Obat *</label>
                        <input type="text" name="nama_obat" id="nama_obat" required 
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                    </div>
                    <div>
                        <label for="ketentuan" class="block text-sm font-medium text-gray-700">Ketentuan *</label>
                        <textarea name="ketentuan" id="ketentuan" required rows="4"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status *</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="1" checked class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="status" value="0" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Tidak Aktif</span>
                            </label>
                        </div>
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
<div id="editObatLuarModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Obat Luar</h3>
            <form id="editObatLuarForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama_obat" class="block text-sm font-medium text-gray-700">Nama Obat *</label>
                        <input type="text" name="nama_obat" id="edit_nama_obat" required 
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A]">
                    </div>
                    <div>
                        <label for="edit_ketentuan" class="block text-sm font-medium text-gray-700">Ketentuan *</label>
                        <textarea name="ketentuan" id="edit_ketentuan" required rows="4"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#048C6A] focus:border-[#048C6A] resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status *</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="1" id="edit_status_aktif" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="status" value="0" id="edit_status_tidak" class="text-[#048C6A] focus:ring-[#048C6A]">
                                <span class="ml-2 text-sm text-gray-700">Tidak Aktif</span>
                            </label>
                        </div>
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
    const btnTambahObat = document.getElementById('btnTambahObat');
    const btnBatalCreate = document.getElementById('btnBatalCreate');
    const btnBatalEdit = document.getElementById('btnBatalEdit');
    const editButtons = document.querySelectorAll('.btn-edit-obat');
    
    // Modal elements
    const createModal = document.getElementById('createObatLuarModal');
    const editModal = document.getElementById('editObatLuarModal');
    const editForm = document.getElementById('editObatLuarForm');

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
    if (btnTambahObat) {
        btnTambahObat.addEventListener('click', function() {
            openModal(createModal);
        });
    }

    if (btnBatalCreate) {
        btnBatalCreate.addEventListener('click', function() {
            closeModal(createModal);
        });
    }

    if (btnBatalEdit) {
        btnBatalEdit.addEventListener('click', function() {
            closeModal(editModal);
        });
    }

    // Event listeners untuk tombol edit
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const obatId = this.getAttribute('data-obat-id');
            const namaObat = this.getAttribute('data-nama-obat');
            const ketentuan = this.getAttribute('data-ketentuan');
            const status = this.getAttribute('data-status');

            // Isi form edit dengan data
            document.getElementById('edit_nama_obat').value = namaObat;
            document.getElementById('edit_ketentuan').value = ketentuan;
            
            if (status === '1') {
                document.getElementById('edit_status_aktif').checked = true;
            } else {
                document.getElementById('edit_status_tidak').checked = true;
            }

            // Set action form
            editForm.action = '/obat-luar/' + obatId;

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