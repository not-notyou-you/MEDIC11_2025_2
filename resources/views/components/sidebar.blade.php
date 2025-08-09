@php
    use Illuminate\Support\Str;
@endphp

<div class="fixed left-0 top-0 w-64 h-full bg-gradient-to-r from-[#048C6A] to-[#144034] p-4 z-[9999] sidebar-menu transition-transform -translate-x-full rounded-lg shadow-glow">
    <div class="flex items-center justify-between pb-4 border-b border-b-white">
        <a href="/" class="font-bold text-white ml-3">
            <img src="{{ asset('assets/logo/MedicWhite_highres.png') }}" alt="Medic White Logo" class="w-32">
        </a>
        <button class="sidebar-close text-white">
            <i class="ri-close-large-line text-white"></i>
        </button>
    </div>

    <ul class="mt-4">
        <li class="mb-1 group">
            <a href="/profile"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'profile.edit' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Profile</span>
            </a>
        </li>

        <li class="mb-1 group">
            <a href="/dashboard"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'dashboard' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Dashboard</span>
            </a>
        </li>

        <li class="mb-1 group">
            <a href="{{ route('service.show') }}"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'service.') && Route::currentRouteName() !== 'service.index' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Services</span>
            </a>
        </li>

        <li class="mb-1 group">
            <a href="{{ route('category.index') }}"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'category.') ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Categories</span>
            </a>
        </li>

        <li class="mb-1 group">
            <a href="{{ route('gallery.index') }}"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'gallery.') && Route::currentRouteName() !== 'gallery.user_index' && Route::currentRouteName() !== 'gallery.user_show' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Galleries</span>
            </a>
        </li>

        <li class="mb-1 group">
            <a href="{{ route('profile.index') }}"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'profile.') && Route::currentRouteName() !== 'profile.edit' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Accounts</span>
            </a>
        </li>

        <li class="mb-1 group">
            <a href="{{ route('home') }}"
                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'home' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                <span class="text-sm">Home</span>
            </a>
        </li>

        @auth
        <li class="mb-1 group mt-6">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full py-2 px-4 bg-gray-300 text-black hover:bg-gray-400 rounded-md">
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </li>
        @endauth
    </ul>
</div>

<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
