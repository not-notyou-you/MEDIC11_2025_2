@extends('layouts.dashboard_template')

@section('content')

<!-- Data untuk JavaScript - Disembunyikan -->
<div id="medicalEquipmentData" 
     data-has-medical="{{ $service->type === 'Alat Kesehatan' ? 'true' : 'false' }}"
     data-equipment="{{ $service->type === 'Alat Kesehatan' ? implode(', ', $service->medical_equipment ?? []) : '' }}"
     style="display: none;">
</div>

<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Modal Konfirmasi -->
    <div id="emailConfirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-[#144034] mb-4">Konfirmasi Pengiriman Email</h3>
            
            <div id="modalContent">
                <!-- Konten akan diisi oleh JavaScript -->
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                    class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                    Batal
                </button>
                <button type="button" onclick="submitEmailForm()"
                    class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                    Kirim
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Status Information -->
    <div id="statusInfoModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 backdrop-blur-md hidden">
        <div onclick="event.stopPropagation()" class="bg-gradient-to-br from-[#e0f2ec] to-[#f5fffc] text-[#144034] rounded-3xl border-8 border-double border-[#319875] shadow-glow w-11/12 max-w-md px-6 py-8 animate-fade-in ring-4 ring-[#a4dbc8]">
            <h2 class="text-xl font-bold text-center mb-4">Informasi Status Layanan</h2>
            
            <div class="space-y-3 text-left">
                <div>
                    <p class="font-bold">PENDING:</p>
                    <p class="ml-4">- Pengajuan belum disetujui</p>
                    <p class="ml-4">- Menunggu verifikasi admin</p>
                </div>
                <div>
                    <p class="font-bold">ON PROGRESS:</p>
                    <p class="ml-4">- Pengajuan telah disetujui</p>
                    <p class="ml-4">- Menunggu hari pelaksanaan</p>
                </div>
                <div>
                    <p class="font-bold">COMPLETED:</p>
                    <p class="ml-4">- Pengajuan telah selesai</p>
                    <p class="ml-4">- Sesuai dengan permintaan</p>
                </div>
                <div>
                    <p class="font-bold">CANCELED:</p>
                    <p class="ml-4">- Pengajuan dibatalkan</p>
                    <p class="ml-4">- Karena beberapa hal</p>
                </div>
            </div>
            
            <p class="mt-4 text-center text-sm text-gray-600">Modal akan tertutup otomatis dalam 10 detik</p>
        </div>
    </div>

    <!-- Judul -->
    <h1 class="text-3xl font-semibold text-[#144034] text-center mb-10">
        {{ $service->event_name }}
    </h1>

    <!-- Informasi Pengajuan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-[#144034] font-medium">
        @php
            $fields = [
                ['name' => 'name', 'label' => 'Nama'],
                ['name' => 'email', 'label' => 'Email'],
                ['name' => 'nim', 'label' => 'NIM'],
                ['name' => 'type', 'label' => 'Tipe'],
                ['name' => 'phone', 'label' => 'No. Telp'],
                ['name' => 'line', 'label' => 'LINE'],
                ['name' => 'organization', 'label' => 'Organisasi'],
                ['name' => 'title', 'label' => 'Jabatan'],
                ['name' => 'event_name', 'label' => 'Nama Acara'],
                ['name' => 'description', 'label' => 'Deskripsi'],
                ['name' => 'created_at', 'label' => 'Tanggal Pengajuan'],
                ['name' => 'date', 'label' => 'Tanggal Acara'],
                ['name' => 'start_time', 'label' => 'Jam Mulai'],
                ['name' => 'end_time', 'label' => 'Jam Selesai'],
                ['name' => 'location', 'label' => 'Lokasi'],
            ];
            if ($service->type == 'Pengajuan Jasa') {
                $fields[] = ['name' => 'person', 'label' => 'Jumlah Orang'];
            }
        @endphp

        @foreach($fields as $field)
        <div>
            <label for="{{ $field['name'] }}" class="block mb-1">{{ $field['label'] }}</label>
            <input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                class="w-full border border-[#048C6A] rounded px-3 py-2 bg-white text-sm"
                value="{{ $service[$field['name']] }}" readonly />
        </div>
        @endforeach

        <!-- Alat Kesehatan -->
        @if ($service->type == 'Alat Kesehatan')
        <div class="sm:col-span-2 lg:col-span-3">
            <label class="block mb-1">Alat Kesehatan yang Dipinjam</label>
            <div class="grid grid-cols-2 gap-4">
                @foreach(['kursi roda', 'tabung oksigen', 'tandu lipat', 'tandu sekop', 'tenda', 'tongkat', 'tas obat dalam', 'tas obat luar', 'tas obat dalam dan luar', 'ice pack', 'ice box'] as $equipment)
                    <div class="flex items-center">
                        <input type="checkbox" class="text-[#048C6A]" id="equipment-{{ $loop->index }}" 
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                            @if(in_array($equipment, $service->medical_equipment ?? [])) checked @endif disabled>
                        <label for="equipment-{{ $loop->index }}" class="ms-2 text-sm font-medium text-gray-900">{{ ucfirst($equipment) }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Catatan -->
        @if (!is_null($service->note))
        <div class="sm:col-span-2 lg:col-span-3">
            <label for="note" class="block mb-1">Catatan</label>
            <textarea id="note" name="note" rows="4"
                class="w-full border border-[#048C6A] rounded px-3 py-2 bg-white text-sm"
                readonly>{{ $service->note }}</textarea>
        </div>
        @endif
    </div>

    <!-- Form Ubah Status -->
    <form action="{{ route('service.update', $service->id) }}" method="POST" class="mt-10">
        @csrf
        @method('PUT')

        <div class="col-span-full sm:w-1/2 mx-auto">
            <div class="flex items-center justify-center mb-2">
                <label for="status" class="block mb-0 mr-2">Status</label>
                <!-- Tombol info status -->
                <button type="button" onclick="showStatusInfo()" 
                    class="bg-[#048C6A] text-white w-6 h-6 rounded-full flex items-center justify-center font-bold hover:bg-[#06D6A0] transition-colors">
                    i
                </button>
            </div>
            <select id="status" name="status"
                class="w-full px-3 py-2 bg-white border border-[#048C6A] text-sm font-medium text-[#144034] rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="{{ App\Models\Service::STATUS_PENDING }}" @if ($service->status == App\Models\Service::STATUS_PENDING) selected @endif>Pending</option>
                <option value="{{ App\Models\Service::STATUS_ON_PROGRESS }}" @if ($service->status == App\Models\Service::STATUS_ON_PROGRESS) selected @endif>On Progress</option>
                <option value="{{ App\Models\Service::STATUS_COMPLETED }}" @if ($service->status == App\Models\Service::STATUS_COMPLETED) selected @endif>Completed</option>
                <option value="{{ App\Models\Service::STATUS_CANCELED }}" @if ($service->status == App\Models\Service::STATUS_CANCELED) selected @endif>Canceled</option>
            </select>
        </div>

        <!-- Tombol Aksi -->
        <div class="sm:col-span-2 lg:col-span-3 mt-6 flex justify-center flex-wrap gap-4">
            <button type="submit"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                Simpan
            </button>

            <a href="{{ route('service.destroy', $service->id) }}"
                onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus layanan ini?')) document.getElementById('delete-form').submit();"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                Hapus
            </a>

            <!-- Tombol Kirim Email -->
            <button type="button" onclick="showConfirmationModal()"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                Kirim Email
            </button>

            <a href="{{ route('service.surat', $service->id) }}" target="_blank"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                Cetak
            </a>

        </div>
    </form>

    <!-- Form tersembunyi untuk submit email -->
    <form id="emailForm" action="{{ route('service.send-email', $service->id) }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" id="cancelReason" name="cancel_reason" value="">
    </form>

    <!-- Form Hapus -->
    <form id="delete-form" action="{{ route('service.destroy', $service->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Tambahkan ini untuk menampilkan notifikasi email -->
    @if(session('email_status'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('email_status') }}
        </div>
    @endif

    @if(session('email_error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('email_error') }}
        </div>
    @endif

    <!-- JavaScript untuk modal -->
    <script>
        function showConfirmationModal() {
            const modal = document.getElementById('emailConfirmationModal');
            const modalContent = document.getElementById('modalContent');
            const status = "{{ $service->status }}";
            const medicalData = document.getElementById('medicalEquipmentData');
            
            let html = `
                <p>Apakah yakin akan mengirim email kepada:</p>
                <div class="mt-3 space-y-2">
                    <p><strong>Nama:</strong> {{ $service->name }}</p>
                    <p><strong>Organisasi:</strong> {{ $service->organization }}</p>
                    <p><strong>Acara:</strong> {{ $service->event_name }}</p>
                    <p><strong>Tipe:</strong> {{ $service->type }}</p>
                    <p><strong>Tanggal:</strong> {{ $service->date }}</p>
                    <p><strong>Status:</strong> {{ $service->status }}</p>
            `;
            
            // Tampilkan alat kesehatan jika tipe Alat Kesehatan
            if (medicalData.dataset.hasMedical === 'true' && medicalData.dataset.equipment) {
                html += `<p><strong>Alat Kesehatan:</strong> ${medicalData.dataset.equipment}</p>`;
            }
            
            if (status === 'Canceled') {
                html += `
                    <div class="mt-3">
                        <label for="reasonInput" class="block text-sm font-medium text-gray-700">Alasan Pembatalan:</label>
                        <textarea id="reasonInput" name="cancel_reason" rows="3" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                            required></textarea>
                    </div>
                `;
            }
            
            html += `</div>`;
            
            modalContent.innerHTML = html;
            modal.classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('emailConfirmationModal').classList.add('hidden');
        }
        
        function submitEmailForm() {
            const status = "{{ $service->status }}";
            const form = document.getElementById('emailForm');
            
            if (status === 'Canceled') {
                const reason = document.getElementById('reasonInput').value;
                if (!reason.trim()) {
                    alert('Harap isi alasan pembatalan');
                    return;
                }
                document.getElementById('cancelReason').value = reason;
            }
            
            form.submit();
            closeModal();
        }
        
        // Fungsi untuk menampilkan modal informasi status
        function showStatusInfo() {
            const modal = document.getElementById('statusInfoModal');
            modal.classList.remove('hidden');

            setTimeout(() => {
                closeStatusModal();
            }, 10000);
        }

        function closeStatusModal() {
            document.getElementById('statusInfoModal').classList.add('hidden');
        }
        
        document.getElementById('statusInfoModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('statusInfoModal')) {
                closeStatusModal();
            }
        });
        
        document.querySelector('#statusInfoModal > div').addEventListener('click', () => {
            closeStatusModal();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const statusForm = statusSelect.closest('form');
            
            statusForm.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin mengubah status pengajuan ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }
        
        .shadow-glow {
            box-shadow: 0 0 15px rgba(72, 187, 120, 0.5);
        }
    </style>
</div>
@endsection