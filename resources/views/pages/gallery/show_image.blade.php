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
        <div class="bg-[#effaf5] rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="flex justify-center items-center p-4 h-[60vh] max-h-[600px] min-h-[300px]">
                <img src="{{ asset($image->path) }}" 
                     alt="{{ $image->title }}" 
                     class="h-full w-full object-scale-down">
            </div>
        </div>

        <!-- Image Info -->
        <div class="bg-[#effaf5] rounded-xl shadow-lg p-4 mb-6">
            <p class="text-sm text-gray-500 text-center mb-4">Diunggah pada: {{ $image->created_at->format('d M Y') }}</p>
            
            <!-- Unified Button Container -->
            <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
                @if($previousImage)
                <a href="{{ route('gallery.show_image', [$category->slug, $previousImage->id]) }}"
                   class="w-full sm:w-auto flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                    <i class="ri-arrow-left-s-line mr-2"></i>
                    <span>Sebelumnya</span>
                </a>
                @endif

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ asset($image->path) }}" 
                       download="{{ Str::slug($image->title) }}.jpg"
                       class="flex-1 flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                        <i class="ri-download-line mr-2"></i>
                        <span>Download</span>
                    </a>
                    
                    <a href="{{ route('gallery.user_show', $category->slug) }}"
                       class="flex-1 flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                        <i class="ri-arrow-left-line mr-2"></i>
                        <span>Kembali </span>
                    </a>
                </div>

                @if($nextImage)
                <a href="{{ route('gallery.show_image', [$category->slug, $nextImage->id]) }}"
                   class="w-full sm:w-auto flex items-center justify-center border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                    <span>Selanjutnya</span>
                    <i class="ri-arrow-right-s-line ml-2"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<x-footer />

@endsection