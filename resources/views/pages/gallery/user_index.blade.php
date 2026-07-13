@extends('layouts.app')

@section('content')
<div class="bg-[#effaf5] min-h-screen">
    <!-- Header Section -->
    <div class="py-10 bg-gradient-to-r from-[#53b490] to-[#3a8d6d]">
        <div class="min-w-screen flex justify-center items-center">
            <h1 class="text-3xl font-bold bg-[#effaf5] text-[#253A35] text-center inline-block px-6 py-2 rounded-lg shadow-lg">
                Gallery
            </h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Categories Grid -->
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            @foreach($categories->sortBy('name') as $category)
            <a href="{{ route('gallery.user_show', $category->slug) }}" 
               class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <!-- Category Image -->
                <div class="aspect-w-1 aspect-h-1 bg-gray-100 overflow-hidden">
                    @if($category->galleries->count() > 0)
                    <img src="{{ asset($category->galleries->first()->path) }}" 
                         alt="{{ $category->name }}" 
                         class="w-full h-40 object-cover object-center transition-transform duration-300 group-hover:scale-105">
                    @else
                    <img src="{{ asset('assets/logo/logo1.png') }}" 
                         alt="{{ $category->name }}" 
                         class="w-full h-40 object-contain object-center p-4">
                    @endif
                </div>
                
                <!-- Category Name -->
                <div class="p-3">
                    <h3 class="text-sm font-semibold text-gray-800 text-center line-clamp-2 leading-tight">
                        {{ $category->name }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Default Images Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-[#3a8d6d] mb-6 text-center">Foto Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                    <img src="{{ asset('assets/foto/pelatihan9.webp') }}" 
                         alt="pelatihan9" 
                         class="w-full h-60 object-cover object-center">
                </div>
                <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                    <img src="{{ asset('assets/foto/pelatihan2.webp') }}" 
                         alt="pelatihan2" 
                         class="w-full h-60 object-cover object-center">
                </div>
                <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                    <img src="{{ asset('assets/foto/pelatihan10.webp') }}" 
                         alt="pelatihan10" 
                         class="w-full h-60 object-cover object-center">
                </div>
                <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                    <img src="{{ asset('assets/foto/pelatihan1.webp') }}" 
                         alt="pelatihan1" 
                         class="w-full h-60 object-cover object-center">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        /* Vendor prefixes untuk kompatibilitas */
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        
        -webkit-line-clamp: 2;
        -moz-line-clamp: 2;
        -ms-line-clamp: 2;
        line-clamp: 2;
        
        -webkit-box-orient: vertical;
        -moz-box-orient: vertical;
        -ms-box-orient: vertical;
        box-orient: vertical;
        
        overflow: hidden;
        
        /* Fallback untuk browser yang tidak support line-clamp */
        max-height: 2.8em;
        line-height: 1.4em;
    }
</style>
@endsection