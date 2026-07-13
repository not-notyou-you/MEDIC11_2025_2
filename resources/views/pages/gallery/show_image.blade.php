@extends('layouts.app')

@section('content')
<div class="bg-[#f8fafc] min-h-screen">
    <!-- Header Section -->
    <div class="py-4 sm:py-6 bg-gradient-to-r from-[#53b490] to-[#3a8d6d]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center">
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold bg-[#effaf5] text-[#253A35] text-center px-4 py-1 sm:px-4 sm:py-2 rounded-lg shadow">
                    {{ $image->title }}
                </h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Image Display -->
        <div id="image-display" class="bg-[#effaf5] rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="flex justify-center items-center p-4 h-[60vh] max-h-[600px] min-h-[300px]">
                <img src="{{ asset($image->path) }}" 
                     alt="{{ $image->title }}" 
                     class="h-full w-full object-scale-down">
            </div>
        </div>

        <!-- Image Info -->
        <div class="bg-[#effaf5] rounded-xl shadow-lg p-4 mb-6">
            <p class="text-sm text-gray-500 text-center mb-4">Diunggah pada: {{ $image->created_at->format('d M Y') }}</p>
            
            <!-- Button Container -->
            <div class="flex flex-col space-y-3">
                <!-- Baris Pertama: Sebelumnya, Download, Selanjutnya -->
                <div class="grid grid-cols-3 gap-3 sm:flex sm:flex-row sm:justify-between">
                    <!-- Tombol Sebelumnya -->
                    @if($previousImage)
                    <a href="{{ route('gallery.show_image', [$category->slug, $previousImage->id]) }}"
                       class="flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-2 py-2 sm:px-4 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] text-sm sm:text-base sm:flex-1">
                        <i class="ri-arrow-left-s-line mr-1 sm:mr-2"></i>
                        <span class="hidden sm:inline">Sebelumnya</span>
                        <span class="sm:hidden">Prev</span>
                    </a>
                    @else
                    <div class="flex items-center justify-center border-2 border-gray-300 text-gray-300 font-semibold px-2 py-2 sm:px-4 rounded-lg shadow-md text-sm sm:text-base sm:flex-1 cursor-not-allowed">
                        <i class="ri-arrow-left-s-line mr-1 sm:mr-2 invisible"></i>
                        <span class="hidden sm:inline invisible">Sebelumnya</span>
                        <span class="sm:hidden invisible">Prev</span>
                    </div>
                    @endif

                    <!-- Tombol Download - PASTIKAN ROUTE BENAR -->
                    <a href="{{ route('gallery.download', $image->id) }}" 
                       class="flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-2 py-2 sm:px-4 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] text-sm sm:text-base sm:flex-1 sm:max-w-[50%]">
                        <i class="ri-download-line mr-1 sm:mr-2"></i>
                        <span>Download</span>
                    </a>

                    <!-- Tombol Selanjutnya -->
                    @if($nextImage)
                    <a href="{{ route('gallery.show_image', [$category->slug, $nextImage->id]) }}"
                       class="flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-2 py-2 sm:px-4 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] text-sm sm:text-base sm:flex-1">
                        <span class="hidden sm:inline">Selanjutnya</span>
                        <span class="sm:hidden">Next</span>
                        <i class="ri-arrow-right-s-line ml-1 sm:ml-2"></i>
                    </a>
                    @else
                    <div class="flex items-center justify-center border-2 border-gray-300 text-gray-300 font-semibold px-2 py-2 sm:px-4 rounded-lg shadow-md text-sm sm:text-base sm:flex-1 cursor-not-allowed">
                        <span class="hidden sm:inline invisible">Selanjutnya</span>
                        <span class="sm:hidden invisible">Next</span>
                        <i class="ri-arrow-right-s-line ml-1 sm:ml-2 invisible"></i>
                    </div>
                    @endif
                </div>

                <!-- Baris Kedua: Kembali -->
                <div class="flex justify-center">
                    <a href="{{ route('gallery.user_show', $category->slug) }}"
                       class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A] text-sm sm:text-base">
                        <i class="ri-arrow-left-line mr-2"></i>
                        <span>Kembali ke Galeri</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Scroll ke bagian foto saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const imageSection = document.getElementById('image-display');
        if (imageSection) {
            // Hitung offset untuk scroll (dikurangi 20px agar tidak terlalu menempel di atas)
            const headerOffset = 60;
            const elementPosition = imageSection.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            // Lakukan scroll
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    });
</script>

@endsection