@extends('layouts.dashboard_template')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
            <h1 class="text-2xl font-semibold text-[#144034] text-center mb-2">Email Blast System</h1>
            <p class="text-center text-lg text-[#144034]">UMN Medical Center</p>
        </div>

        <!-- Upload Section -->
        <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
            <h2 class="text-xl font-semibold text-[#144034] mb-6 text-center">Kirim Email Blast</h2>
            
            @if(session('success'))
                <div class="flex items-center p-4 mb-6 text-[#144034] border border-[#048C6A] rounded-lg bg-[#e0f2e9]"
                     role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 lg:w-5 lg:h-5 me-3" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <p class="text-sm font-semibold">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center p-4 mb-6 text-red-800 border border-red-300 rounded-lg bg-red-50"
                     role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 lg:w-5 lg:h-5 me-3" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <p class="text-sm font-semibold">
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            <form action="{{ route('email-blast.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- File Upload -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="file" name="excel_file" id="excel_file" 
                           accept=".xlsx,.xls,.csv" required
                           class="block py-2.5 px-0 w-full text-sm text-[#144034] bg-transparent border-0 border-b-2 border-[#048C6A] appearance-none focus:outline-none focus:ring-0 focus:border-[#048C6A] peer"/>
                    <label for="excel_file"
                           class="peer-focus:font-semibold absolute text-sm text-[#048C6A] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#048C6A] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        File Excel *
                    </label>
                    <p class="text-xs text-[#048C6A] mt-2 font-medium">
                        Format: Kolom pertama harus "email", diikuti kolom variabel lainnya
                    </p>
                </div>

                <!-- Subject Input -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="email_subject" id="email_subject" required
                           class="block py-2.5 px-0 w-full text-sm text-[#144034] bg-transparent border-0 border-b-2 border-[#048C6A] appearance-none focus:outline-none focus:ring-0 focus:border-[#048C6A] peer"
                           placeholder=" "/>
                    <label for="email_subject"
                           class="peer-focus:font-semibold absolute text-sm text-[#048C6A] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#048C6A] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Subject Email *
                    </label>
                </div>

                <!-- Email Content -->
                <div class="relative z-0 w-full mb-6 group">
                    <textarea name="email_content" id="email_content" rows="8" required
                              class="block py-2.5 px-0 w-full text-sm text-[#144034] bg-transparent border-0 border-b-2 border-[#048C6A] appearance-none focus:outline-none focus:ring-0 focus:border-[#048C6A] peer resize-none"
                              placeholder=" "></textarea>
                    <label for="email_content"
                           class="peer-focus:font-semibold absolute text-sm text-[#048C6A] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#048C6A] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Konten Email *
                    </label>
                    <p class="text-xs text-[#048C6A] mt-2 font-medium">
                        Gunakan (nama_kolom) untuk variabel dari Excel
                    </p>
                </div>

                <!-- Preview Variables -->
                <div class="mb-6 p-4 bg-[#e0f2e9] rounded-lg border border-[#048C6A]">
                    <h3 class="font-semibold text-[#144034] mb-3">Contoh Penggunaan Variabel:</h3>
                    <p class="text-sm text-[#144034] mb-3 font-medium">
                        Jika Excel memiliki kolom: <strong class="text-[#048C6A]">email, nama, kelas, lomba</strong>
                    </p>
                    <pre class="bg-white p-4 rounded border border-[#048C6A] text-sm text-[#144034] font-mono font-semibold">
Hallo (nama) dari kelas (kelas)
selamat anda menjadi pemenang (lomba)</pre>
                    <p class="text-xs text-[#048C6A] mt-3 font-semibold">
                        <strong>Note:</strong> Variabel juga bisa digunakan di subject email!
                    </p>
                </div>

                <div class="flex justify-center">
                    <button type="submit" 
                            class="text-white bg-[#048C6A] hover:bg-[#036c52] focus:ring-4 focus:outline-none focus:ring-[#048C6A]/50 font-semibold rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center transition duration-300 shadow-md">
                        Queue Email
                    </button>
                </div>
            </form>
        </div>

        <!-- Queue Status -->
        <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
            <h2 class="text-xl font-semibold text-[#144034] mb-6 text-center">Status Email Queue</h2>
            
            <div id="queueStatus" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-[#e0f2e9] border border-[#048C6A] p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                    <div class="text-2xl font-bold text-[#144034]" id="totalEmails">0</div>
                    <div class="text-sm text-[#144034] font-semibold">Total Email</div>
                </div>
                <div class="bg-[#e0f2e9] border border-[#048C6A] p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                    <div class="text-2xl font-bold text-[#144034]" id="sentEmails">0</div>
                    <div class="text-sm text-[#144034] font-semibold">Terkirim</div>
                </div>
                <div class="bg-[#e0f2e9] border border-[#048C6A] p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                    <div class="text-2xl font-bold text-[#144034]" id="pendingEmails">0</div>
                    <div class="text-sm text-[#144034] font-semibold">Pending</div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 mb-4">
                <form action="{{ route('email-blast.process') }}" method="POST" class="w-full sm:flex-1">
                    @csrf
                    <button type="submit" 
                            class="text-white bg-[#048C6A] hover:bg-[#036c52] focus:ring-4 focus:outline-none focus:ring-[#048C6A]/50 font-semibold rounded-lg text-sm w-full px-5 py-2.5 text-center transition duration-300 shadow-md">
                        Proses Pengiriman Email
                    </button>
                </form>

                <form action="{{ route('email-blast.clear') }}" method="POST" class="w-full sm:flex-1">
                    @csrf
                    <button type="submit" 
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-semibold rounded-lg text-sm w-full px-5 py-2.5 text-center transition duration-300 shadow-md"
                            onclick="return confirm('Yakin ingin menghapus semua email pending?')">
                        Clear Queue
                    </button>
                </form>
            </div>

            <!-- Info Section -->
            <div class="p-4 bg-[#e0f2e9] rounded-lg border border-[#048C6A]">
                <p class="text-sm text-[#144034] font-semibold">
                    <strong>Tips:</strong> 
                    Sistem akan mengirim email secara bertahap untuk menghindari limit SMTP. 
                    Klik "Proses Pengiriman Email" beberapa kali jika email banyak.
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let intervalId = null;
    let isPageVisible = true;

    // Auto refresh queue status
    function updateQueueStatus() {
        fetch('{{ route("email-blast.status") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalEmails').textContent = data.total;
                document.getElementById('sentEmails').textContent = data.sent;
                document.getElementById('pendingEmails').textContent = data.pending;
            })
            .catch(error => console.error('Error fetching queue status:', error));
    }

    // Fungsi untuk memulai interval
    function startInterval() {
        if (!intervalId) {
            intervalId = setInterval(updateQueueStatus, 10000); // 10 detik
            console.log('Auto refresh dimulai');
        }
    }

    // Fungsi untuk menghentikan interval
    function stopInterval() {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
            console.log('Auto refresh dihentikan');
        }
    }

    // Handle visibility change
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            // Halaman tidak terlihat
            stopInterval();
            isPageVisible = false;
        } else {
            // Halaman terlihat kembali
            startInterval();
            updateQueueStatus(); // Update segera
            isPageVisible = true;
        }
    });

    // Handle window focus/blur
    window.addEventListener('blur', function() {
        stopInterval();
    });
    
    window.addEventListener('focus', function() {
        startInterval();
        updateQueueStatus();
    });

    // Handle page unload
    window.addEventListener('beforeunload', function() {
        stopInterval();
    });

    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        // Initial load
        updateQueueStatus();
        
        // Mulai interval jika halaman terlihat
        if (!document.hidden) {
            startInterval();
        }

        // Add floating label behavior for inputs
        const inputs = document.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            if (input.value) {
                input.classList.add('has-value');
            }
            
            input.addEventListener('input', function() {
                if (this.value) {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });

            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    });
</script>

<style>
    /* Custom styles for floating labels */
    input:focus ~ label,
    textarea:focus ~ label,
    input.has-value ~ label,
    textarea.has-value ~ label {
        transform: translateY(-1.5rem) scale(0.75);
        color: #048C6A;
        font-weight: 600;
    }
    
    /* Enhanced focus styles */
    input:focus, textarea:focus {
        border-color: #048C6A;
        box-shadow: 0 2px 0 0 #048C6A;
    }
    
    /* File input custom styling */
    input[type="file"] {
        padding-top: 1rem;
    }
    
    input[type="file"]::-webkit-file-upload-button {
        visibility: hidden;
    }
    
    input[type="file"]::before {
        content: 'Pilih file';
        display: inline-block;
        background: #048C6A;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        margin-right: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
    }
    
    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #048C6A;
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #036c52;
    }

    /* Hover effects */
    .hover\:shadow-md:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>
@endpush
@endsection