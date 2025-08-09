@extends('layouts.app')

@section('content')

<div class="bg-[#effaf5] min-h-screen">
    <!-- Header Section -->
    <div class="py-10 bg-gradient-to-r from-[#53b490] to-[#3a8d6d]">
        <div class="min-w-screen h-3 flex justify-center items-center">
            <h1 class="text-3xl font-bold bg-[#effaf5] text-[#253A35] text-center inline-block px-6 py-2 rounded-lg shadow-lg">
                Gallery
            </h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8 fade-zoom">
            <!-- Categories Sidebar -->
            <div class="lg:w-1/5">
                <h1 class="text-2xl font-semibold text-[#3a8d6d] mb-6">Kategori Acara</h1>
                <div class="space-y-4">
                    @foreach ($categories as $category)
                    <a href="{{ route('gallery.user_show', $category->slug) }}"
                       class="block w-full text-center px-6 py-3 border-2 border-[#048C6A] text-[#048C6A] font-semibold rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Featured Images -->
            <div class="lg:w-4/5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                        <img src="{{ asset('assets/foto/pelatihan9.jpg') }}" 
                             alt="pelatihan9" 
                             class="w-full h-72 object-cover object-center">
                    </div>
                    <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                        <img src="{{ asset('assets/foto/pelatihan2.jpg') }}" 
                             alt="pelatihan2" 
                             class="w-full h-72 object-cover object-center">
                    </div>
                    <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                        <img src="{{ asset('assets/foto/pelatihan10.jpg') }}" 
                             alt="pelatihan10" 
                             class="w-full h-72 object-cover object-center">
                    </div>
                    <div class="overflow-hidden rounded-xl shadow-xl transform transition-all hover:scale-[1.02] duration-300">
                        <img src="{{ asset('assets/foto/pelatihan1.jpg') }}" 
                             alt="pelatihan1" 
                             class="w-full h-72 object-cover object-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer />

@endsection