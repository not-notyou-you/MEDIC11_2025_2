@extends('layouts.dashboard_template')

@section('content')

<div class="p-8 bg-white min-h-[500px] rounded-lg shadow-md">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-[#048C6A] mb-2">Upload Photos to Gallery</h1>
        <p class="text-gray-600">Upload and manage your gallery images</p>
    </div>

    <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Error Messages -->
        @if($errors->any())
        <div class="bg-[#ffe5e5] border-l-4 border-[#e53935] text-[#a01010] px-4 py-3 rounded-lg shadow-inner mb-4">
            <p class="font-semibold">Error!</p>
            @foreach($errors->all() as $error)
            <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Category Selection -->
        <div class="mb-6">
            <label for="category" class="block text-[#048C6A] font-semibold text-sm mb-1">Category</label>
            <select id="category" name="category_id" required
                class="w-full px-4 py-2 border-2 border-[#048C6A] rounded-lg text-[#048C6A] bg-white shadow-inner outline-none focus:ring-2 focus:ring-[#06D6A0] font-medium">
                <option value="" disabled selected>Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Title Input -->
        <div class="mb-6">
            <label for="title" class="block text-[#048C6A] font-semibold text-sm mb-1">Image Title</label>
            <input type="text" id="title" name="title" required
                placeholder="Enter a descriptive title for your image"
                class="w-full px-4 py-2 border-2 border-[#048C6A] rounded-lg text-[#048C6A] bg-white shadow-inner outline-none focus:ring-2 focus:ring-[#06D6A0] font-medium">
        </div>

        <!-- User ID (hidden) -->
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <!-- File Upload -->
        <div class="mb-6">
            <label for="images" class="block text-[#048C6A] font-semibold text-sm mb-1">Select Images</label>
            <input type="file" id="images" name="images[]" multiple required
                accept="image/jpeg,image/png,image/jpg,image/webp"
                class="w-full px-4 py-2 border-2 border-[#048C6A] rounded-lg text-[#048C6A] bg-white shadow-inner outline-none focus:ring-2 focus:ring-[#06D6A0] font-medium">
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-8">
            <a href="{{ route('gallery.index') }}" 
               class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Back to Gallery
            </a>
            <button type="submit"
                    class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                <i class="fas fa-check-circle mr-2"></i> Upload Files
            </button>
        </div>
    </form>
</div>

@endsection