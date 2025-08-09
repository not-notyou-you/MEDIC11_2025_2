@extends('layouts.dashboard_template')

@section('content')
<div class="min-h-screen bg-[#effaf5] p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6 mb-6">
        <h1 class="text-2xl font-semibold text-[#144034] text-center mb-2">
            Photo Categories Management
        </h1>
        <p class="text-center text-lg text-[#144034]">Organize and manage your photo categories</p>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg border border-[#048C6A] shadow-md shadow-black/5 p-6">
        @if (session()->has('status'))
        <div class="mb-6">
            <div class="flex items-center p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-[#ebf5ff]"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 lg:w-5 lg:h-5 me-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <p class="text-sm font-medium">
                    {{ session()->get('status') }}
                </p>
            </div>
        </div>
        @endif

        <div class="flex flex-col space-y-4 justify-center sm:space-y-0 sm:flex-row sm:justify-between mb-5">
            <h2 class="text-xl font-semibold text-[#144034]">Category List</h2>
            <button id="toggleFormBtn"
                class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                Add New Category
            </button>
        </div>

        <div id="addCategoryForm" class="hidden mb-8">
            <div class="relative my-4 flex mx-auto w-full lg:w-8/12 justify-center flex-col rounded-xl text-gray-700">
                <form class="leading-relaxed block w-full mx-auto" action="{{ route('category.store') }}" method="POST">
                    @csrf

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="name" id="name"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="name"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Category Name</label>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                        class="border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if ($categories->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full min-w-[540px]">
                <thead>
                    <tr class="bg-[#048C6A]/10">
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tl-md rounded-bl-md border-r border-[#048C6A]/20">
                            ID</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Name</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Slug</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Created At</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left border-r border-[#048C6A]/20">
                            Updated At</th>
                        <th class="text-[12px] uppercase tracking-wide font-semibold text-[#144034] py-2 px-4 text-left rounded-tr-md rounded-br-md">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="hover:bg-[#e0f2e9]">
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $category->id }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20 hover:underline">
                            <a href="{{ route('category.edit', $category->slug) }}"
                                class="text-[#144034] text-sm font-semibold">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $category->slug }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $category->formatted_created_at }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <span class="text-[13px] font-semibold text-[#144034]">{{ $category->formatted_updated_at }}</span>
                        </td>
                        <td class="py-2 px-4 border-b border-[#048C6A]/20">
                            <form action="{{ route('category.destroy', $category->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm font-semibold hover:text-red-800 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-5">{{ $categories->links('vendor.pagination.tailwind') }}</div>
        @else
        <div class="min-h-96 flex flex-col items-center justify-center p-10 border border-dashed border-[#048C6A] rounded-lg">
            <i class="ri-folder-open-line text-6xl text-[#048C6A] mb-4"></i>
            <p class="text-xl font-semibold text-center text-[#144034]">No categories found</p>
            <p class="text-center text-gray-500 mt-2">Start by creating your first category</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleFormBtn');
    const formContainer = document.getElementById('addCategoryForm');

    toggleBtn.addEventListener('click', function() {
        formContainer.classList.toggle('hidden');
    });
});
</script>
@endpush
@endsection