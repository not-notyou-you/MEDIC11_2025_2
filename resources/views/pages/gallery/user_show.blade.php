@extends('layouts.app')

@section('content')
<div class="bg-[#effaf5] min-h-screen">
    <!-- Header Section -->
    <div class="py-2 mt-4 sm:py-4 bg-gradient-to-r from-[#53b490] to-[#3a8d6d]">
        <div class="flex justify-center items-center">
            <h1 class="text-lg sm:text-2xl md:text-3xl font-bold bg-[#effaf5] text-[#253A35] text-center px-4 py-2 sm:px-6 sm:py-3 rounded-lg shadow">
                {{ $currentCategory->name }}
            </h1>
        </div>
    </div>

    @if ($categories->count() > 1)
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8 sm:mt-12 py-4 px-4 sm:px-6 bg-[#effaf5] rounded-xl shadow">
            @if ($previousCategory)
            <a href="{{ route('gallery.user_show', $previousCategory->slug) }}"
               class="w-full sm:w-auto text-center px-4 py-2 sm:px-6 sm:py-3 border-2 border-[#048C6A] text-[#048C6A] font-semibold rounded-lg shadow-md transition-colors duration-200 hover:bg-[#048C6A] hover:text-white">
                <i class="ri-arrow-left-s-line mr-2"></i>
                <span class="text-sm sm:text-base">{{ $previousCategory->name }}</span>
            </a>
            @endif

            <a href="{{ route('gallery.user_index') }}"
               class="w-full sm:w-auto text-center px-4 py-2 sm:px-6 sm:py-3 border-2 border-[#048C6A] text-[#048C6A] font-semibold rounded-lg shadow-md transition-colors duration-200 hover:bg-[#048C6A] hover:text-white">
                <span>back to gallery</span>
            </a>

            @if ($nextCategory)
            <a href="{{ route('gallery.user_show', $nextCategory->slug) }}"
               class="w-full sm:w-auto text-center px-4 py-2 sm:px-6 sm:py-3 border-2 border-[#048C6A] text-[#048C6A] font-semibold rounded-lg shadow-md transition-colors duration-200 hover:bg-[#048C6A] hover:text-white">
                <span class="text-sm sm:text-base">{{ $nextCategory->name }}</span>
                <i class="ri-arrow-right-s-line ml-2"></i>
            </a>
            @endif
        </div>
    @endif

    <div class="w-full mx-auto py-8 sm:py-12 px-4 sm:px-6"> <!-- Perubahan padding disini -->
        @if ($galleries->isEmpty())
        <div class="text-center py-8 sm:py-12">
            <h1 class="text-xl sm:text-2xl font-semibold text-[#3a8d6d]">Mohon maaf, tidak ada foto pada album ini</h1>
        </div>
        @else
        <!-- Perubahan grid layout disini -->
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($galleries as $gallery)
            <a href="{{ route('gallery.show_image', [$currentCategory->slug, $gallery->id]) }}" 
               class="block bg-[#effaf5] rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                    <img src="{{ asset($gallery->path) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>
                <div class="p-3">
                    <h3 class="text-xs sm:text-sm font-semibold text-gray-800 truncate">{{ $gallery->title }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $gallery->created_at->format('d M Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>

</div>

<!-- Modal Structure - You can keep this as fallback or remove it -->
<div id="imageModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800"></h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="flex-1 overflow-auto p-4">
            <div class="flex justify-center items-center h-full">
                <img id="modalImage" src="" alt="" class="max-w-full max-h-[70vh] object-contain">
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-between items-center p-4 border-t">
            <p id="modalDate" class="text-sm text-gray-500"></p>
            <div class="flex gap-3">
                <a id="downloadBtn" href="#" download class="px-4 py-2 bg-[#048C6A] text-white rounded-lg hover:bg-[#036a4f] transition-colors flex items-center gap-2">
                    <i class="ri-download-line"></i>
                    <span>Download</span>
                </a>
                <button id="closeModalBtn" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// You can keep this JavaScript as fallback or remove it
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const closeButtons = document.querySelectorAll('#closeModal, #closeModalBtn');

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    closeButtons.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});
</script>
@endpush