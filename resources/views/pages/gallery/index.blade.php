@extends('layouts.dashboard_template')

@section('content')

<div class="mx-auto min-h-[500px] p-6 sm:p-12 bg-white">
    @if (session()->has('status'))
    <div class="bg-[#d1f7e8] border-l-4 border-[#048C6A] text-[#048C6A] px-4 py-3 rounded-lg shadow-inner mb-6">
        <p class="font-semibold">Success!</p>
        <p class="text-sm">{{ session('status') }}</p>
    </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar Categories -->
        <div class="lg:w-1/4">
            <div class="bg-white border border-[#048C6A] rounded-lg overflow-hidden">
                <div class="bg-[#048C6A] text-white px-6 py-3 text-center font-semibold">
                    Select Category
                </div>
                <ul class="divide-y divide-[#e5e7eb]">
                    @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('gallery.index', ['category' => $category->slug]) }}" 
                           class="block px-6 py-3 hover:bg-[#f0fdf4] transition-colors duration-200 {{ $currentCategory && $category->slug == $currentCategory->slug ? 'bg-[#d1f7e8]' : '' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <a href="{{ route('gallery.create') }}"
               class="mt-4 block w-full text-center px-6 py-3 bg-[#048C6A] text-white font-semibold rounded-lg hover:bg-[#036a4f] transition-colors duration-200">
                Upload Photos
            </a>
        </div>
        
        <!-- Main Content -->
        <div class="lg:w-3/4">
            @if ($galleries->isEmpty())
            <div class="text-center py-12">
                <h1 class="text-2xl font-semibold text-gray-800 mb-2">No Photos Found</h1>
                <p class="text-gray-600">
                    @if($currentCategory)
                    There are no photos in {{ $currentCategory->name }}
                    @else
                    There are no photos in this category
                    @endif
                </p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($galleries as $gallery)
                <div class="border border-[#e5e7eb] rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="aspect-w-4 aspect-h-3 bg-gray-100 overflow-hidden">
                        <a href="{{ asset($gallery->path) }}" data-fancybox="gallery" data-caption="{{ $gallery->title }}">
                            <img src="{{ asset($gallery->path) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-48 object-cover object-center">
                        </a>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-[#048C6A]">{{ $gallery->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $gallery->created_at->format('d M Y') }} by {{ $gallery->user->first_name }}
                        </p>
                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-sm text-[#e53935] hover:text-[#b71c1c] flex items-center">
                                <i class="ri-delete-bin-line mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@endsection