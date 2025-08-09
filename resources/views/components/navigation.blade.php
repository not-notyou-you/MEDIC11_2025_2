<nav class="px-4 lg:px-16 py-4 flex flex-no-wrap justify-between items-center bg-[#D5DECD] sticky z-50">
    <a class="leading-none" href="/">
        <img src="{{ asset('assets/logo/MedicGreen_highres.png') }}" alt="Logo Medic" class="h-12 w-auto">
    </a>
    <div class="lg:hidden">
        <button class="navbar-burger flex items-center text-[#9BAA89] p-3">
            <svg class="block h-6 w-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Mobile menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </button>
    </div>
    
    <ul class="hidden lg:flex lg:items-center lg:w-auto lg:space-x-4">
        <li><a class="font-medium transition duration-300 text-base text-[#1F262F] hover:text-gray-500 {{ Route::currentRouteName() == 'home' ? 'font-semibold' : '' }}"
                href="{{ route('home') }}">Home</a></li>
        <li class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 24 32" fill="none"
                stroke="#1F262F" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="current-fill">
                <line x1="12" y1="6" x2="12" y2="26"></line>
            </svg>
        </li>
        <li><a class="font-medium transition duration-300 text-base text-[#1F262F] hover:text-gray-500 {{ Route::currentRouteName() == 'About' || Route::currentRouteName() == 'about.read-more' ? 'font-semibold' : '' }}"
                href="{{ route('about') }}">About</a></li>
        <li class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 24 32" fill="none"
                stroke="#1F262F" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="current-fill">
                <line x1="12" y1="6" x2="12" y2="26"></line>
            </svg>
        </li>
        <li><a class="font-medium transition duration-300 text-base text-[#1F262F] hover:text-gray-500 {{ Route::currentRouteName() == 'proker' ? 'font-semibold' : '' }}"
                href="{{ route('proker') }}">Proker</a></li>
        <li class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 24 32" fill="none"
                stroke="#1F262F" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="current-fill">
                <line x1="12" y1="6" x2="12" y2="26"></line>
            </svg>
        </li>
        <li><a class="font-medium transition duration-300 text-base text-[#1F262F] hover:text-gray-500 {{ Route::currentRouteName() == 'contact.index' ? 'font-semibold' : '' }}"
                href="{{ route('contact.index') }}">Contact</a></li>
        <li class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 24 32" fill="none"
                stroke="#1F262F" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="current-fill">
                <line x1="12" y1="6" x2="12" y2="26"></line>
            </svg>
        </li>
        <li><a class="font-medium transition duration-300 text-base text-[#1F262F] hover:text-gray-500 {{ Route::currentRouteName() == 'gallery.index' ? 'font-semibold' : '' }}"
                href="{{ route('gallery.user_index') }}">Gallery</a></li>
        @auth
        <li class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 24 32" fill="none"
                stroke="#1F262F" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="current-fill">
                <line x1="12" y1="6" x2="12" y2="26"></line>
            </svg>
        </li>
        <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                class="font-medium transition duration-300 text-base text-[#1F262F] hover:text-gray-500 {{ $title === 'Dashboard' ? 'font-semibold' : '' }} border-b border-gray-100 md:hover:bg-transparent md:border-0 pl-3 pr-4 py-2 md:p-0 font-medium flex items-center justify-between w-full md:w-auto">{{
                Auth::user()->first_name }}
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg></button>

            <div id="dropdownNavbar"
                class="hidden bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow my-4 w-44">
                <ul class="py-1" aria-labelledby="dropdownLargeButton">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Dashboard</a>
                    </li>
                </ul>
                <div class="py-1">
                    <form action="{{ route('logout') }}" method="POST"
                        class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </li>
        @endauth

    </ul>
</nav>

<div class="navbar-menu relative z-50 hidden">
    <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
    <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
        <div class="flex items-center mb-8">
            <a class="mr-auto text-3xl font-bold leading-none" href="#">
                <img src="{{ asset('assets/logo/MedicGreen_highres.png') }}" alt="Logo Medic" class="h-12 w-auto">
            </a>
            <button class="navbar-close">
                <svg class="h-6 w-6 text-[#9BAA89] cursor-pointer hover:text-gray-500"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div>
            <ul>
                <li class="mb-1">
                    <a class="block p-4 text-sm font-medium text-[#1F262F] hover:bg-gray-50 hover:text-gray-600 rounded {{ $title === 'Home' ? 'font-semibold' : '' }}"
                        href="/">Home</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 text-sm font-medium text-[#1F262F] hover:bg-gray-50 hover:text-gray-600 rounded {{ $title === 'About' ? 'font-semibold' : '' }}"
                        href="/about">About</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 text-sm font-medium text-[#1F262F] hover:bg-gray-50 hover:text-gray-600 rounded {{ $title === 'Proker' ? 'font-semibold' : '' }}"
                        href="/proker">Proker</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 text-sm font-medium text-[#1F262F] hover:bg-gray-50 hover:text-gray-600 rounded {{ $title === 'Contact' ? 'font-semibold' : '' }}"
                        href="/contact">Contact</a>
                </li>
                <li class="mb-1">
                    <a class="block p-4 text-sm font-medium text-[#1F262F] hover:bg-gray-50 hover:text-gray-600 rounded {{ $title === 'Gallery' ? 'font-semibold' : '' }}"
                        href="/gallery">Gallery</a>
                </li>
            </ul>
        </div>
        {{-- <div class="mt-auto">
            <div class="pt-6">
                <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold bg-gray-50 hover:bg-gray-100 rounded-xl"
                    href="#">Sign in</a>
                <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl"
                    href="#">Sign Up</a>
            </div>
        </div> --}}
    </nav>
</div>

<script>
    // Burger menus
    document.addEventListener('DOMContentLoaded', function() {
        // open
        const burger = document.querySelectorAll('.navbar-burger');
        const menu = document.querySelectorAll('.navbar-menu');

        if (burger.length && menu.length) {
            for (var i = 0; i < burger.length; i++) {
                burger[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }

        // close
        const close = document.querySelectorAll('.navbar-close');
        const backdrop = document.querySelectorAll('.navbar-backdrop');

        if (close.length) {
            for (var i = 0; i < close.length; i++) {
                close[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }

        if (backdrop.length) {
            for (var i = 0; i < backdrop.length; i++) {
                backdrop[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }
    });
</script>