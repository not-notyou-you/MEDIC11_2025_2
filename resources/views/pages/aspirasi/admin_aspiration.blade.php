@extends('layouts.dashboard_template')

@section('content')

<div class="rounded-md border bg-[#effaf5] border-gray-100 m-6 px-0 sm:p-6 shadow-md shadow-black/5">
    
    <!-- Judul Utama -->
    <div class="mb-8 text-center">
        <h1 class="text-xl md:text-3xl font-bold text-[#144034] mb-3">
            Aspirasi terhadap UMN Medical Center
        </h1>
        <div class="w-20 h-1 bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] mx-auto rounded-full"></div>
        <p class="text-gray-600 mt-3 text-sm max-w-2xl mx-auto">
            Tinjau semua masukan dan saran
        </p>
    </div>

    <!-- Statistik Overview -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 shadow border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-blue-50 rounded mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Aspirasi</p>
                    <p class="text-lg font-bold text-gray-900">{{ $aspirasis->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 shadow border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-green-50 rounded mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Dari Nama Jelas</p>
                    <p class="text-lg font-bold text-gray-900">{{ $aspirasis->where('nama', '!=', 'Anonim')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 shadow border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-gray-100 rounded mr-3">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Aspirasi Anonim</p>
                    <p class="text-lg font-bold text-gray-900">{{ $aspirasis->where('nama', 'Anonim')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 shadow border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-purple-50 rounded mr-3">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Panjang Rata-rata</p>
                    <p class="text-lg font-bold text-gray-900">
                        @if($aspirasis->count() > 0)
                            {{ round($aspirasis->avg(fn($a) => strlen($a->pesan))) }} karakter
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Kartu Aspirasi Terakhir -->
        <div class="bg-white rounded-lg p-4 shadow border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-50 rounded mr-3">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Aspirasi Terakhir</p>
                    <p class="text-lg font-bold text-gray-900" id="lastAspirationTime">
                        @if($aspirasis->count() > 0)
                            @php
                                $lastAspiration = $aspirasis->first();
                                $diffInDays = $lastAspiration->created_at->startOfDay()->diffInDays(now()->startOfDay());
                                
                                if ($diffInDays == 0) {
                                    echo "Hari ini";
                                } elseif ($diffInDays == 1) {
                                    echo "1 hari yang lalu";
                                } else {
                                    echo $diffInDays . " hari yang lalu";
                                }
                            @endphp
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow border border-gray-100 overflow-hidden">
            <div class="p-3 border-b border-gray-100">
                <h2 class="text-base font-bold text-[#144034]">Filter Aspirasi</h2>
            </div>
            <div class="p-3">
                <div class="flex flex-wrap gap-2">
                    <button type="button" onclick="filterAspirations('all')" 
                            class="px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-[#048C6A] text-white hover:bg-[#036951] active:scale-95">
                        Semua ({{ $aspirasis->count() }})
                    </button>
                    <button type="button" onclick="filterAspirations('anonim')" 
                            class="px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200 active:scale-95">
                        Anonim ({{ $aspirasis->where('nama', 'Anonim')->count() }})
                    </button>
                    <button type="button" onclick="filterAspirations('named')" 
                            class="px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200 active:scale-95">
                        Ber-nama ({{ $aspirasis->where('nama', '!=', 'Anonim')->count() }})
                    </button>
                    <button type="button" onclick="filterAspirations('over100')" 
                            class="px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200 active:scale-95">
                        >100 karakter ({{ $aspirasis->filter(fn($a) => strlen($a->pesan) > 100)->count() }})
                    </button>
                    <button type="button" onclick="filterAspirations('over300')" 
                            class="px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200 active:scale-95">
                        >300 karakter ({{ $aspirasis->filter(fn($a) => strlen($a->pesan) > 300)->count() }})
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Grid -->
    <div id="aspirationsContainer">
        @if($aspirasis->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($aspirasis as $aspirasi)
            <div class="aspiration-card bg-white rounded-lg border border-gray-200 hover:border-[#048C6A] hover:shadow-md transition-all duration-200 cursor-pointer group"
                 data-id="{{ $aspirasi->id }}"
                 data-nama="{{ $aspirasi->nama }}"
                 data-anonim="{{ $aspirasi->nama === 'Anonim' ? 'true' : 'false' }}"
                 data-date="{{ $aspirasi->created_at->format('Y-m-d') }}"
                 data-length="{{ strlen($aspirasi->pesan) }}">
                
                <!-- Card Header -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex justify-between items-start">
                        <!-- Nama Pengirim -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2 {{ $aspirasi->nama === 'Anonim' ? 'bg-gray-100 text-gray-600' : 'bg-[#048C6A] text-white' }}">
                                @if($aspirasi->nama === 'Anonim')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-sm">{{ $aspirasi->nama }}</h3>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    @if($aspirasi->nama === 'Anonim')
                                    <span class="bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded text-xs font-medium">Anonim</span>
                                    @else
                                    <span class="bg-green-100 text-green-600 px-1.5 py-0.5 rounded text-xs font-medium">Nama Jelas</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <!-- Tanggal -->
                        <div class="text-right">
                            <div class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @php
                                    $diffInDays = $aspirasi->created_at->startOfDay()->diffInDays(now()->startOfDay());
                                    if ($diffInDays == 0) {
                                        echo 'Hari ini';
                                    } elseif ($diffInDays == 1) {
                                        echo '1 hari lalu';
                                    } else {
                                        echo $diffInDays . ' hari lalu';
                                    }
                                @endphp
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                {{ $aspirasi->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Card Content -->
                <div class="p-4">
                    <div class="mb-3">
                        <h4 class="text-xs font-medium text-gray-500 mb-1">Isi Aspirasi:</h4>
                        <p class="text-gray-700 text-sm leading-relaxed">
                            {{ Str::limit($aspirasi->pesan, 15, '.......') }}
                        </p>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex justify-between text-xs text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            {{ strlen($aspirasi->pesan) }} karakter
                        </div>
                        <div class="flex items-center text-[#048C6A] group-hover:underline">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Klik untuk detail
                        </div>
                    </div>
                </div>
                
                <!-- Card Footer -->
                <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            ID: {{ $aspirasi->id }}
                        </span>
                        <div class="text-xs text-gray-400">
                            {{ $aspirasi->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Empty State Message (hidden by default) -->
        <div id="emptyState" class="hidden min-h-[300px] flex flex-col items-center justify-center p-8">
            <div class="w-24 h-24 mb-4 opacity-20">
                <svg class="w-full h-full text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <h3 class="text-base font-bold text-gray-500 mb-1">Tidak ada aspirasi</h3>
            <p class="text-gray-400 text-center text-sm max-w-md">
                Belum ada aspirasi yang masuk untuk filter yang dipilih.
            </p>
        </div>
        @else
        <!-- Empty State (when no aspirations at all) -->
        <div class="min-h-[300px] flex flex-col items-center justify-center p-8">
            <div class="w-32 h-32 mb-6 opacity-10">
                <svg class="w-full h-full text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <h1 class="text-lg font-bold text-gray-400 mb-2">Tidak ada aspirasi saat ini</h1>
            <p class="text-gray-500 text-center text-sm max-w-lg mb-6">
                Belum ada aspirasi yang masuk ke sistem.
            </p>
        </div>
        @endif
    </div>
</div>

<!-- Modal Detail Aspirasi -->
<div id="aspirationModal" 
     class="hidden fixed inset-0 z-50 overflow-y-auto"
     data-modal-state="closed">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/30 transition-opacity modal-overlay"></div>
    
    <!-- Modal Container -->
    <div class="flex min-h-full items-center justify-center p-4">
        <!-- Modal Content - Background hijau muda, border hijau tua -->
        <div class="relative bg-[#f0f9f6] rounded-lg shadow-lg border-2 border-[#0A6B4F] w-full max-w-lg modal-content">
            <!-- Modal Header - Lebih ringkas -->
            <div class="px-4 py-3 border-b border-[#048C6A] bg-[#e6f4f0] rounded-t-lg">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-[#144034]">Detail Aspirasi</h3>
                    </div>
                </div>
            </div>
            
            <!-- Modal Body - Lebih ringkas secara vertikal -->
            <div class="p-4">
                <!-- Sender Info - Compact -->
                <div class="mb-4 p-3 bg-white rounded border border-[#cce8e1]">
                    <div class="flex items-center">
                        <div id="modalAvatar" class="w-9 h-9 rounded-full flex items-center justify-center mr-3 text-white">
                            <!-- Avatar diisi JavaScript -->
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 id="modalName" class="font-bold text-gray-900 text-sm truncate mb-0.5"></h4>
                            <div class="flex items-center">
                                <svg class="w-3.5 h-3.5 text-gray-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="modalDate" class="text-xs text-gray-600 truncate"></span>
                            </div>
                        </div>
                        <div class="text-right pl-2">
                            <div class="text-xs text-gray-500 mb-0.5">ID</div>
                            <div id="modalId" class="text-sm font-bold text-[#0A6B4F]"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Message Content - Padding lebih kecil -->
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h4 class="text-sm font-semibold text-gray-900">Isi Aspirasi</h4>
                        </div>
                        <div class="px-2 py-0.5 bg-[#e6f4f0] rounded text-xs border border-[#cce8e1]">
                            <span id="modalLength" class="text-[#0A6B4F] font-medium"></span>
                        </div>
                    </div>
                    <div id="modalMessage" class="p-3 bg-white rounded border border-[#cce8e1] text-gray-700 text-sm leading-relaxed whitespace-pre-wrap max-h-52 overflow-y-auto">
                        <!-- Message diisi JavaScript -->
                    </div>
                </div>
                
                <!-- Modal Footer - Tombol hijau tua, layout compact -->
                <div class="flex justify-between items-center pt-3 border-t border-[#048C6A]">
                    <button type="button" 
                            class="close-modal-btn px-3.5 py-2 bg-white text-[#0A6B4F] text-sm font-medium rounded border border-[#0A6B4F] hover:bg-[#f0f9f6] transition-colors duration-150 flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Tutup
                    </button>
                    <div class="flex space-x-2">
                        <button type="button" 
                                id="deleteButton"
                                class="delete-aspiration-btn px-3.5 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition-colors duration-150 flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                        <button type="button" 
                                class="copy-aspiration-btn px-3.5 py-2 bg-[#0A6B4F] text-white text-sm font-medium rounded hover:bg-[#144034] transition-colors duration-150 flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 hidden">
    <div class="bg-gradient-to-r from-[#048C6A] to-[#0A6B4F] text-white px-5 py-3 rounded-lg shadow-lg flex items-center animate-fade-in min-w-[280px] justify-center">
        <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span id="toastMessage" class="text-sm font-medium"></span>
    </div>
</div>

<!-- Error Toast -->
<div id="errorToast" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 hidden">
    <div class="bg-gradient-to-r from-red-500 to-red-600 text-white px-5 py-3 rounded-lg shadow-lg flex items-center animate-fade-in min-w-[280px] justify-center">
        <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span id="errorToastMessage" class="text-sm font-medium"></span>
    </div>
</div>

@endsection

@push('scripts')
<script>

// ==================== MODAL SYSTEM - FIXED VERSION ====================
let modalOpen = false;
let currentAspirationId = null;

// Event delegation untuk kartu aspirasi
document.addEventListener('click', function(e) {
    // Jika klik pada kartu aspirasi
    const card = e.target.closest('.aspiration-card');
    if (card) {
        e.preventDefault();
        e.stopPropagation();
        const id = card.getAttribute('data-id');
        openAspirationModal(id);
        return;
    }
    
    // Jika klik pada tombol tutup modal
    if (e.target.closest('.close-modal-btn')) {
        closeAspirationModal();
        return;
    }
    
    // Jika klik pada tombol hapus
    if (e.target.closest('.delete-aspiration-btn')) {
        deleteAspiration();
        return;
    }
    
    // Jika klik pada tombol salin
    if (e.target.closest('.copy-aspiration-btn')) {
        copyAspiration();
        return;
    }
    
    // Jika klik pada overlay modal
    if (e.target.classList.contains('modal-overlay')) {
        closeAspirationModal();
        return;
    }
});

// Escape key untuk tutup modal
document.addEventListener('keydown', function(e) {
    if (modalOpen && e.key === 'Escape') {
        closeAspirationModal();
    }
});

// Fungsi buka modal
async function openAspirationModal(id) {
    if (modalOpen) return;
    
    console.log('Opening modal for ID:', id);
    modalOpen = true;
    currentAspirationId = id;
    
    // Ambil modal element
    const modal = document.getElementById('aspirationModal');
    if (!modal) {
        console.error('Modal element not found!');
        return;
    }
    
    // Tampilkan modal
    modal.classList.remove('hidden');
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
    
    // Set loading state
    document.getElementById('modalName').textContent = 'Memuat...';
    document.getElementById('modalDate').textContent = 'Memuat...';
    document.getElementById('modalMessage').textContent = 'Memuat detail aspirasi...';
    document.getElementById('modalLength').textContent = '...';
    document.getElementById('modalId').textContent = '...';
    
    try {
        // Fetch data dari server
        const response = await fetch(`/admin/aspirasi/${id}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Data received:', data);
        
        // Update modal dengan data
        updateModalWithData(data);
        
    } catch (error) {
        console.error('Error loading aspiration:', error);
        showToast('Gagal memuat detail aspirasi', 'error');
        closeAspirationModal();
    }
}

// Fungsi update modal dengan data
function updateModalWithData(data) {
    const name = data.nama;
    const isAnonim = name === 'Anonim';
    const date = new Date(data.created_at);
    
    // Format tanggal
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const msgDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    const diffTime = today.getTime() - msgDate.getTime();
    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
    
    let dateString = '';
    if (diffDays === 0) {
        dateString = `Hari ini, ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
    } else if (diffDays === 1) {
        dateString = `1 hari lalu, ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
    } else {
        dateString = `${diffDays} hari lalu, ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
    }
    
    // Update avatar
    const avatar = document.getElementById('modalAvatar');
    if (avatar) {
        avatar.className = `w-10 h-10 rounded-full flex items-center justify-center mr-3 ${isAnonim ? 'bg-gray-200 text-gray-700' : 'bg-[#048C6A] text-white'}`;
        avatar.innerHTML = isAnonim ? 
            `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>` :
            `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>`;
    }
    
    // Update teks
    const nameEl = document.getElementById('modalName');
    const dateEl = document.getElementById('modalDate');
    const messageEl = document.getElementById('modalMessage');
    const lengthEl = document.getElementById('modalLength');
    const idEl = document.getElementById('modalId');
    
    if (nameEl) nameEl.textContent = name;
    if (dateEl) dateEl.textContent = dateString;
    if (messageEl) messageEl.textContent = data.pesan;
    if (lengthEl) lengthEl.textContent = `${data.pesan.length} karakter`;
    if (idEl) idEl.textContent = `#${data.id}`;
}

// Fungsi tutup modal
function closeAspirationModal() {
    const modal = document.getElementById('aspirationModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
    document.body.style.overflow = 'auto';
    modalOpen = false;
    currentAspirationId = null;
}

// Fungsi hapus aspirasi - FIXED
async function deleteAspiration() {
    if (!currentAspirationId) {
        console.error('No aspiration ID selected');
        return;
    }
    
    const nameEl = document.getElementById('modalName');
    const name = nameEl ? nameEl.textContent : 'Aspirasi';
    
    if (!confirm(`Yakin ingin menghapus aspirasi dari "${name}"?`)) {
        return;
    }
    
    try {
        console.log('Deleting aspiration ID:', currentAspirationId);
        
        // Kirim request DELETE dengan CSRF token yang benar
        const response = await fetch(`/admin/aspirasi/${currentAspirationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('Delete response status:', response.status);
        
        if (!response.ok) {
            const errorData = await response.json();
            console.error('Delete failed:', errorData);
            throw new Error(errorData.message || `Delete failed with status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Delete success:', data);
        
        // Hapus kartu dari UI
        const card = document.querySelector(`.aspiration-card[data-id="${currentAspirationId}"]`);
        if (card) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(-10px)';
            card.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                card.remove();
                updateEmptyState();
            }, 300);
        }
        
        // Tutup modal
        closeAspirationModal();
        
        // Tampilkan toast sukses
        showToast('Aspirasi berhasil dihapus', 'success');
        
        // Reload halaman untuk update statistik
        setTimeout(() => {
            location.reload();
        }, 1500);
        
    } catch (error) {
        console.error('Delete error:', error);
        showToast('Gagal menghapus aspirasi: ' + error.message, 'error');
    }
}

// Fungsi salin aspirasi - FIXED dengan notifikasi
function copyAspiration() {
    const messageEl = document.getElementById('modalMessage');
    const nameEl = document.getElementById('modalName');
    const dateEl = document.getElementById('modalDate');
    
    if (!messageEl || !nameEl || !dateEl) {
        showToast('Gagal menyalin: elemen tidak ditemukan', 'error');
        return;
    }
    
    const message = messageEl.textContent;
    const name = nameEl.textContent;
    const date = dateEl.textContent;
    
    const textToCopy = `Aspirasi dari: ${name}\nTanggal: ${date}\n\n${message}`;
    
    console.log('Copying text:', textToCopy);
    
    navigator.clipboard.writeText(textToCopy)
        .then(() => {
            console.log('Text copied successfully');
            showToast('Aspirasi berhasil disalin ke clipboard', 'success');
        })
        .catch((err) => {
            console.error('Failed to copy text:', err);
            showToast('Gagal menyalin ke clipboard', 'error');
        });
}

// FUNGSI TOAST YANG BERHASIL

// FUNGSI TOAST YANG DIPERBAIKI - POSISI TENGAH BAWAH
function showToast(message, type = 'success') {
    console.log(`Showing toast: ${message} (${type})`);
    
    // Pilih toast berdasarkan type
    let toast, toastMessage;
    
    if (type === 'error') {
        toast = document.getElementById('errorToast');
        toastMessage = document.getElementById('errorToastMessage');
    } else {
        toast = document.getElementById('successToast');
        toastMessage = document.getElementById('toastMessage');
    }
    
    if (!toast || !toastMessage) {
        console.error('Toast elements not found!');
        // Fallback ke alert
        if (type === 'error') {
            alert('❌ ' + message);
        } else {
            alert('✅ ' + message);
        }
        return;
    }
    
    // Set pesan
    toastMessage.textContent = message;
    
    // Tampilkan toast
    toast.classList.remove('hidden');
    
    // Hilangkan toast lain jika ada
    if (type === 'error') {
        document.getElementById('successToast')?.classList.add('hidden');
    } else {
        document.getElementById('errorToast')?.classList.add('hidden');
    }
    
    // Auto hide setelah 3 detik
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Juga perbaiki fungsi copyAspiration untuk menggunakan fungsi toast yang baru
function copyAspiration() {
    const messageEl = document.getElementById('modalMessage');
    const nameEl = document.getElementById('modalName');
    const dateEl = document.getElementById('modalDate');
    
    if (!messageEl || !nameEl || !dateEl) {
        showToast('Gagal menyalin: elemen tidak ditemukan', 'error');
        return;
    }
    
    const message = messageEl.textContent;
    const name = nameEl.textContent;
    const date = dateEl.textContent;
    
    const textToCopy = `Aspirasi dari: ${name}\nTanggal: ${date}\n\n${message}`;
    
    console.log('Copying text:', textToCopy);
    
    navigator.clipboard.writeText(textToCopy)
        .then(() => {
            console.log('Text copied successfully');
            showToast('Aspirasi berhasil disalin', 'success');
        })
        .catch((err) => {
            console.error('Failed to copy text:', err);
            showToast('Gagal menyalin', 'error');
        });
}

// Fungsi filter aspirations
function filterAspirations(filterType) {
    const cards = document.querySelectorAll('.aspiration-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        let shouldShow = true;
        const isAnonim = card.dataset.anonim === 'true';
        const length = parseInt(card.dataset.length);
        
        switch(filterType) {
            case 'all':
                shouldShow = true;
                break;
            case 'anonim':
                shouldShow = isAnonim;
                break;
            case 'named':
                shouldShow = !isAnonim;
                break;
            case 'over100':
                shouldShow = length > 100;
                break;
            case 'over300':
                shouldShow = length > 300;
                break;
        }
        
        if (shouldShow) {
            card.style.display = 'block';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
            visibleCount++;
        } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            setTimeout(() => {
                card.style.display = 'none';
            }, 200);
        }
    });
    
    // Update empty state
    updateEmptyState();
    
    // Update active filter button
    updateActiveFilterButton(filterType);
}

// Update active filter button
function updateActiveFilterButton(activeFilter) {
    const buttons = document.querySelectorAll('button[onclick^="filterAspirations"]');
    buttons.forEach(btn => {
        const filterType = btn.onclick.toString().match(/'([^']+)'/)[1];
        if (filterType === activeFilter) {
            btn.className = 'px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-[#048C6A] text-white hover:bg-[#036951] active:scale-95';
        } else {
            btn.className = 'px-3 py-1.5 rounded text-sm font-medium transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200 active:scale-95';
        }
    });
}

// Update empty state visibility
function updateEmptyState() {
    const cards = document.querySelectorAll('.aspiration-card');
    const visibleCards = Array.from(cards).filter(card => 
        card.style.display !== 'none' && 
        window.getComputedStyle(card).display !== 'none' &&
        card.style.opacity !== '0'
    );
    
    const emptyState = document.getElementById('emptyState');
    if (emptyState) {
        if (visibleCards.length === 0 && cards.length > 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }
}

// Pastikan modal tertutup saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing modal system');
    
    const modal = document.getElementById('aspirationModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        console.log('Modal initialized and hidden');
    } else {
        console.error('Modal element not found!');
    }
    
    // Setup awal untuk empty state
    updateEmptyState();
});

</script>

<style>

/* Tambahkan di bagian style */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.aspiration-card {
    transition: all 0.2s ease;
}

.aspiration-card:hover {
    transform: translateY(-2px);
}

#modalMessage::-webkit-scrollbar {
    width: 6px;
}

#modalMessage::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

#modalMessage::-webkit-scrollbar-thumb {
    background: #048C6A;
    border-radius: 3px;
}

#modalMessage::-webkit-scrollbar-thumb:hover {
    background: #036951;
}

/* Modal lebih minimalis */
#aspirationModal .modal-content {
    animation: fade-in 0.2s ease-out;
}

</style>
@endpush