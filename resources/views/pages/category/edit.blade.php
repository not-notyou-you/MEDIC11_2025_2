@extends('layouts.dashboard_template')

@section('content')

<div class="min-h-[500px] bg-white rounded-md border border-gray-100 p-6 flex items-center">
    <form class="max-w-md w-full mx-auto" action="{{ route('category.update', $category->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <h1 class="text-2xl text-center sm:text-left font-semibold text-gray-800 mb-12">Edit Photo Category</h1>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="name" id="name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required value="{{ old('name', $category->name) }}" />
            <label for="name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            @error('name')
            <span class="text-red-500 text-[11px]">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('category.index') }}" 
               class="text-gray-500 hover:text-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Cancel
            </a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Save
            </button>
        </div>
    </form>
</div>

@endsection