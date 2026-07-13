<!-- Header/Navbar -->
<header class="bg-gradient-to-r from-[#048C6A] to-[#144034] text-white py-3 px-6 flex justify-between items-center shadow-lg fixed top-0 left-0 right-0 z-50">
    <!-- Logo & Title -->
    <div class="flex items-center space-x-3">
        <img id="logo" src="{{ asset('assets/logo/logo1.webp') }}" alt="Logo" class="rotating-logo h-10 w-10 object-contain rounded-full">
        <span class="text-xl font-bold hidden sm:block tracking-tight">UMN MEDICAL CENTER</span>
    </div>
    
    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex items-center space-x-1">
        <!-- Primary Navigation -->
        <a href="{{ route('home') }}" class="nav-link px-4 py-2 rounded-lg font-bold">Home</a>
        <a href="{{ route('about') }}" class="nav-link px-4 py-2 rounded-lg font-bold">About</a>
        <a href="{{ route('program') }}" class="nav-link px-4 py-2 rounded-lg font-bold">Program</a>
        <a href="{{ route('service.index') }}" class="nav-link px-4 py-2 rounded-lg font-bold">Service</a>
        
        <!-- Alive Button (Highlighted) -->
        <a href="{{ route('alive.index') }}" 
           class="alive-btn px-2 py-1 rounded-lg font-bold flex space-x-2 ml-2 hover:scale-105 transition-transform">
            <img src="{{ asset('assets/logo/alive.webp') }}" 
                 alt="Alive" 
                 class="w-6 h-6 object-contain animate-heartbeat">
            <span>Alive</span>
        </a>
        
        <!-- More Dropdown -->
        <div id="moreDropdownContainer" class="relative">
            <button id="moreButton" class="nav-link px-4 py-2 rounded-lg flex items-center font-bold">
                More
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="moreDropdown" class="dropdown-content absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden border border-[#144034]">
                <!-- Navigation Items -->
                <a href="{{ route('organigram') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Organigram</a>
                <a href="{{ route('gallery.user_index') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Gallery</a>
                <a href="{{ route('aspirasi.index') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Aspirasi</a>
                <a href="{{ route('public.quiz.index') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Quiz</a>
                
                <!-- Account Section in More Dropdown -->
                <div class="border-t border-gray-200 mt-1 pt-1">
                    @auth
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Admin Profile</a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Workspace</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-[#144034] hover:bg-green-50 font-bold">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Menu Button -->
    <button id="menuButton" class="lg:hidden btn-hover bg-white text-[#144034] px-3 py-1 rounded-lg font-bold flex items-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>
</header>

<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-[#144034] bg-opacity-50 hidden z-40"></div>

<!-- Mobile Sidebar -->
<div id="sidebarMenu" class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50 overflow-y-auto flex flex-col">
    <!-- Sidebar Header -->
    <div class="p-4 border-b border-[#144034] flex justify-between items-center bg-gradient-to-r from-[#048C6A] to-[#144034]">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/logo/logo1.webp') }}" alt="Logo" class="h-8 w-8 object-contain rounded-full">
            <span class="text-lg font-bold text-white">MENU</span>
        </div>
        <button id="closeSidebar" class="text-white hover:text-red-300 text-3xl font-bold transition-all">&times;</button>
    </div>
    
    <!-- Sidebar Content -->
    <div class="flex-1 p-4 flex flex-col space-y-3">
        <!-- Navigation Items -->
        <a href="{{ route('home') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Home
        </a>
        
        <a href="{{ route('about') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            About
        </a>
        
        <a href="{{ route('program') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Program
        </a>
        
        <a href="{{ route('organigram') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Organigram
        </a>
        
        <a href="{{ route('service.index') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            Service
        </a>
        
        <a href="{{ route('gallery.user_index') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Gallery
        </a>
        
        <!-- Alive with Special Styling -->
        <a href="{{ route('alive.index') }}" 
           class="alive-btn px-4 py-3 rounded-lg font-bold flex items-center justify-center border border-[#4F352F] hover:scale-105 transition-transform">
            <img src="{{ asset('assets/logo/alive.webp') }}" 
                 alt="Alive" 
                 class="w-6 h-6 object-contain animate-heartbeat mr-2">
            Alive
        </a>
        
        <a href="{{ route('aspirasi.index') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            Aspirasi
        </a>
        
        <a href="{{ route('public.quiz.index') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Quiz
        </a>
        
        <!-- Account Section in Mobile -->
        <div class="pt-4 mt-4 border-t border-[#144034]">
            <p class="px-4 py-2 text-sm text-[#144034] font-bold">ACCOUNT</p>
            
            @auth
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                    <a href="{{ route('admin.profile') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Admin Profile
                    </a>
                @endif
                
                <a href="{{ route('dashboard') }}" class="nav-link-mobile px-4 py-3 rounded-lg text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Workspace
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="nav-link-mobile w-full text-left px-4 py-3 rounded-lg mt-3 text-[#144034] hover:bg-green-100 transition-all flex items-center font-bold border border-[#144034]">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-hover bg-[#048C6A] text-white px-4 py-3 rounded-lg font-bold mt-2 flex items-center justify-center border border-[#048C6A] hover:border-[#144034]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
            @endauth
        </div>
    </div>
</div>