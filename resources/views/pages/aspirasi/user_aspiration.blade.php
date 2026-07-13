@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#048C6A] via-[#0A6B4F] to-[#144034] pt-20 pb-12 md:pt-24 md:pb-16">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 tracking-tight">
                SUARA UNTUK
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#B5FFD9] to-[#7AFFB8] mt-2">
                    KEMAJUAN
                </span>
            </h1>
            <p class="text-base md:text-lg text-white/85 mb-6 max-w-2xl mx-auto">
                Aspirasi Anda membentuk masa depan kami. Bagikan visi Anda <br>
                untuk UMN Medical Center yang lebih baik.
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="py-10 md:py-12 bg-[#effaf5]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Guidelines -->
            <div class="lg:col-span-1 space-y-5">
                <!-- Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-[#048C6A] overflow-hidden">
                    <div class="bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] px-5 py-3">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Penting
                        </h3>
                    </div>
                    <div class="p-5">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-blue-50 rounded-md flex items-center justify-center">
                                        <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Ruang Lingkup</h4>
                                    <p class="text-xs text-gray-600 mt-0.5">Aspirasi dapat berupa saran, kritik, atau ide untuk pengembangan UMN Medical Center.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-green-50 rounded-md flex items-center justify-center">
                                        <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Bersifat Konstruktif</h4>
                                    <p class="text-xs text-gray-600 mt-0.5">Sampaikan aspirasi dengan bahasa yang sopan dan membangun.</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-6 h-6 bg-purple-50 rounded-md flex items-center justify-center">
                                        <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Rahasia</h4>
                                    <p class="text-xs text-gray-600 mt-0.5">Identitas Anda akan dirahasiakan jika memilih untuk anonim.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Guidelines -->
                <div class="bg-gray-50 rounded-xl border border-[#048C6A] p-5">
                    <h3 class="font-semibold text-gray-900 mb-3 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Panduan Aspirasi
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-700">
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-2">•</span>
                            <span>Jelaskan dengan spesifik dan konstruktif</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-2">•</span>
                            <span>Fokus pada solusi, bukan hanya masalah</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-2">•</span>
                            <span>Gunakan bahasa yang sopan dan profesional</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-2">•</span>
                            <span>Semua pengiriman bersifat rahasia</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Right Column - Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-[#048C6A] overflow-hidden">
                    <div class="bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] px-6 py-4">
                        <div class="flex items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-white mb-1">Bagikan Aspirasi Anda</h2>
                                <p class="text-white/90 text-sm">Masukan Anda berarti untuk kemajuan kami</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Success Message -->
                    <div id="successMessage" class="hidden mx-6 mt-4 p-3 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-green-800">Aspirasi Anda berhasil dikirim.</p>
                            </div>
                        </div>
                        <button onclick="this.parentElement.classList.add('hidden')" class="text-green-600 hover:text-green-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Form -->
                    <div class="p-6">
                        <form id="aspirationForm" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Name Input -->
                            <div class="space-y-2">
                                <label for="nama" class="block text-sm font-medium text-gray-900">
                                    Nama <span class="text-gray-500 font-normal text-xs">(opsional - akan dirahasiakan jika kosong)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="nama"
                                           name="nama" 
                                           placeholder="Masukkan nama Anda atau biarkan kosong untuk anonim"
                                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:border-[#048C6A] focus:ring-1 focus:ring-[#048C6A] focus:outline-none text-sm bg-white">
                                </div>
                            </div>
                            
                            <!-- Message Input -->
                            <div class="space-y-2 py-2">
                                <div class="flex justify-between items-center">
                                    <label for="pesan" class="block text-sm font-medium text-gray-900">
                                        Isi Aspirasi <span class="text-red-500">*</span>
                                    </label>
                                    <span id="charCount" class="text-xs text-gray-500">0/2000</span>
                                </div>
                                <textarea 
                                    id="pesan"
                                    name="pesan" 
                                    rows="6"
                                    placeholder="Tuliskan kritik, saran, atau ide konstruktif untuk pengembangan UMN Medical Center..."
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-[#048C6A] focus:ring-1 focus:ring-[#048C6A] focus:outline-none resize-none text-sm bg-white"
                                ></textarea>
                                <p class="text-xs text-gray-500">
                                    Harap spesifik dan konstruktif. Minimal 10 karakter, maksimal 2000 karakter.
                                </p>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="button" onclick="submitAspiration()"
                                        class="w-full bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] text-white font-medium py-3 px-6 rounded-lg hover:from-[#036951] hover:to-[#084E3A] transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                    <span>Kirim Aspirasi</span>
                                </button>
                                
                                <p class="text-center text-gray-500 text-xs mt-3">
                                    Dengan mengirimkan, Anda menyetujui bahwa aspirasi Anda akan digunakan untuk tujuan pengembangan.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Background Overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" onclick="closeSuccessModal()"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-md bg-white rounded-xl shadow-lg">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-[#048C6A] to-[#0A6B4F]">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Aspirasi Terkirim!</h3>
                        <p class="text-white/90 text-sm">Terima kasih atas kontribusi Anda</p>
                    </div>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-6">
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 mb-4 text-green-500">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Terima Kasih!</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Aspirasi Anda telah berhasil dikirim. Tim UMN Medical Center akan meninjau masukan Anda.
                    </p>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <button type="button" 
                        onclick="closeSuccessModal()"
                        class="w-full px-4 py-2 bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] text-white font-medium rounded-lg hover:from-[#036951] hover:to-[#084E3A] transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.getElementById('pesan');
    const charCount = document.getElementById('charCount');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/2000`;
            
            if (length > 1800) {
                charCount.className = 'text-xs text-red-600';
            } else if (length > 1500) {
                charCount.className = 'text-xs text-amber-600';
            } else {
                charCount.className = 'text-xs text-gray-500';
            }
        });
    }
});

// Simplified submission function
async function submitAspiration() {
    const form = document.getElementById('aspirationForm');
    const textarea = document.getElementById('pesan');
    const submitBtn = document.querySelector('button[type="button"]');
    
    // Simple validation
    if (!textarea.value.trim() || textarea.value.trim().length < 10) {
        showError('Aspirasi minimal 10 karakter');
        return;
    }
    
    if (textarea.value.length > 2000) {
        showError('Aspirasi maksimal 2000 karakter');
        return;
    }
    
    // Loading state
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = `
        <svg class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Mengirim...
    `;
    submitBtn.disabled = true;
    
    try {
        const formData = new FormData(form);
        
        const response = await fetch("{{ route('aspirasi.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            body: formData
        });
        
        if (response.ok) {
            showSuccessModal();
            form.reset();
            document.getElementById('charCount').textContent = '0/2000';
            document.getElementById('successMessage').classList.remove('hidden');
        } else {
            showError('Terjadi kesalahan saat mengirim aspirasi');
        }
        
    } catch (error) {
        showError('Terjadi kesalahan jaringan');
    } finally {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
}

// Show success modal
function showSuccessModal() {
    document.getElementById('successModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Close success modal
function closeSuccessModal() {
    document.getElementById('successModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Show error message
function showError(message) {
    // Remove existing error
    const existingError = document.querySelector('.form-error');
    if (existingError) existingError.remove();
    
    // Create error element
    const errorDiv = document.createElement('div');
    errorDiv.className = 'form-error mx-6 mt-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded-lg mb-4 flex items-start';
    errorDiv.innerHTML = `
        <svg class="w-4 h-4 text-red-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div class="text-sm">${message}</div>
        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 ml-auto pl-2">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    
    const formHeader = document.querySelector('#aspirationForm');
    if (formHeader) {
        formHeader.prepend(errorDiv);
        errorDiv.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<style>
.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
@endsection