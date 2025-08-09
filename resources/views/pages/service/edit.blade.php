@extends('layouts.dashboard_template')

@section('content')
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
                @foreach(['kursi roda', 'tabung oksigen', 'tandu lipat', 'tandu sekop', 'tenda'] as $equipment)
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

        <div class="col-span-full sm:w-1/2 mx-auto text-center">
            <label for="status" class="block mb-1">Status</label>
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

            <a href="{{ route('service.download-word', $service->id) }}" target="_blank"
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
            @if($service->type === 'Alat Kesehatan')
            html += `<p><strong>Alat Kesehatan:</strong> {{ implode(', ', $service->medical_equipment ?? []) }}</p>`;
            @endif
            
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
                document.getElementById('cancelReason').value = reason;
            }
            
            form.submit();
            closeModal();
        }
    </script>
</div>
@endsection