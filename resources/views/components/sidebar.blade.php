@php
    use Illuminate\Support\Str;
@endphp

<div class="fixed left-0 top-0 w-64 h-full bg-gradient-to-r from-[#048C6A] to-[#144034] p-4 z-[9999] sidebar-menu transition-transform -translate-x-full rounded-lg shadow-glow overflow-hidden">
    <div class="flex items-center justify-between pb-4 border-b border-b-white">
        <a href="/" class="font-bold text-white ml-3">
            <img src="{{ asset('assets/logo/MedicWhite_highres.webp') }}" alt="Medic White Logo" class="w-32">
        </a>
        <button class="sidebar-close text-white">
            <i class="ri-close-large-line text-white"></i>
        </button>
    </div>

    <!-- Scrollable menu area dengan custom scrollbar -->
    <div class="h-[calc(100vh-120px)] overflow-y-auto mt-4 sidebar-scrollbar">
        <ul class="space-y-1">
            @if(auth()->user()->is_admin)
            <!-- ADMIN VIEW - Dengan Accordion di Setiap Bagian -->
            
            <!-- GENERAL NAVIGATION Accordion -->
            @php
                $generalActive = Route::currentRouteName() === 'profile.edit' || 
                               Route::currentRouteName() === 'dashboard' ||
                               (Str::startsWith(Route::currentRouteName(), 'service.') && Route::currentRouteName() !== 'service.index') ||
                               Route::currentRouteName() === 'home';
            @endphp
            <li class="mb-1 group">
                <details class="sidebar-accordion" {{ $generalActive ? 'open' : '' }}>
                    <summary class="flex items-center justify-between py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md cursor-pointer text-gray-300">
                        <span class="text-sm font-semibold">GENERAL NAVIGATION</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-200"></i>
                    </summary>
                    <ul class="ml-2 mt-1 space-y-1">
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
                            <a href="{{ route('home') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'home' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Public Pages</span>
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <!-- CAMPUS HEALTH Accordion -->
            @php
                $campusActive = Str::startsWith(Route::currentRouteName(), 'obat-luar.') ||
                              Str::startsWith(Route::currentRouteName(), 'obat-minum.') ||
                              Route::currentRouteName() === 'pasien.create' ||
                              Route::currentRouteName() === 'pasien.index' ||
                              Str::startsWith(Route::currentRouteName(), 'peminjaman-alat.');
            @endphp
            <li class="mb-1 group">
                <details class="sidebar-accordion" {{ $campusActive ? 'open' : '' }}>
                    <summary class="flex items-center justify-between py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md cursor-pointer text-gray-300">
                        <span class="text-sm font-semibold">CAMPUS HEALTH</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-200"></i>
                    </summary>
                    <ul class="ml-2 mt-1 space-y-1">
                        <li class="mb-1 group">
                            <a href="{{ route('obat-luar.index') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'obat-luar.') ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">External Medicine</span>
                            </a>
                        </li>

                        <li class="mb-1 group">
                            <a href="{{ route('obat-minum.index') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'obat-minum.') ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Internal Medicine</span>
                            </a>
                        </li>

                        <li class="mb-1 group">
                            <a href="{{ route('pasien.create') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'pasien.create' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Patient Form</span>
                            </a>
                        </li>

                        <li class="mb-1 group">
                            <a href="{{ route('pasien.index') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'pasien.index' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Patient Records</span>
                            </a>
                        </li>

                        <li class="mb-1 group">
                            <a href="{{ route('peminjaman-alat.index') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'peminjaman-alat.') ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Equipment Borrowing</span>
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <!-- MANAGEMENT Accordion -->
            @php
                $managementActive = Str::startsWith(Route::currentRouteName(), 'category.') ||
                                  (Str::startsWith(Route::currentRouteName(), 'gallery.') && Route::currentRouteName() !== 'gallery.user_index' && Route::currentRouteName() !== 'gallery.user_show') ||
                                  Route::currentRouteName() === 'aspirasi.admin' ||
                                  Route::currentRouteName() === 'admin.quiz.';
            @endphp
            <li class="mb-1 group">
                <details class="sidebar-accordion" {{ $managementActive ? 'open' : '' }}>
                    <summary class="flex items-center justify-between py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md cursor-pointer text-gray-300">
                        <span class="text-sm font-semibold">MANAGEMENT</span>
                        <i class="ri-arrow-down-s-line transition-transform duration-200"></i>
                    </summary>
                    <ul class="ml-2 mt-1 space-y-1">
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
                            <a href="{{ route('aspirasi.admin') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'aspirasi.admin' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Aspirations</span>
                            </a>
                        </li>

                        <li class="mb-1 group">
                            <a href="{{ route('admin.quiz.index') }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'admin.quiz.index' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                                <span class="text-sm">Quizzes</span>
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <!-- SUPERADMIN ONLY Accordion -->
            @if(auth()->user()->is_admin == 2)
                @php
                    $superadminActive = (Str::startsWith(Route::currentRouteName(), 'profile.') && Route::currentRouteName() !== 'profile.edit') ||
                                      Route::currentRouteName() === 'email-blast.index';
                @endphp
                <li class="mb-1 group">
                    <details class="sidebar-accordion" {{ $superadminActive ? 'open' : '' }}>
                        <summary class="flex items-center justify-between py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md cursor-pointer text-gray-300 bg-gradient-to-r from-purple-700/30 to-purple-900/30 border border-purple-500/30">
                            <span class="text-sm font-semibold text-white">
                                SUPERADMIN ONLY
                            </span>
                            <i class="ri-arrow-down-s-line transition-transform duration-200"></i>
                        </summary>
                        <ul class="ml-2 mt-1 space-y-1">
                            <li class="mb-1 group">
                                <a href="{{ route('profile.index') }}"
                                    class="flex items-center py-2 px-4 hover:bg-purple-500/30 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'profile.') && Route::currentRouteName() !== 'profile.edit' ? 'bg-purple-500/30 text-white' : 'text-gray-300' }}">
                                    <i class="ri-user-settings-line mr-2"></i>
                                    <span class="text-sm">Accounts</span>
                                </a>
                            </li>

                            <li class="mb-1 group">
                                <a href="{{ route('email-blast.index') }}"
                                    class="flex items-center py-2 px-4 hover:bg-purple-500/30 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'email-blast.index' ? 'bg-purple-500/30 text-white' : 'text-gray-300' }}">
                                    <i class="ri-mail-send-line mr-2"></i>
                                    <span class="text-sm">Blast Email</span>
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            @endif

            @else
            <!-- USER BIASA VIEW - Tanpa Accordion, Hanya Grouping -->
            
            <!-- GENERAL NAVIGATION -->
            <li class="pt-2 pb-1">
                <div class="px-4">
                    <span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">GENERAL NAVIGATION</span>
                </div>
            </li>

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
                <a href="{{ route('home') }}"
                    class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'home' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                    <span class="text-sm">Home</span>
                </a>
            </li>

            <!-- CAMPUS HEALTH -->
            <li class="pt-4 pb-1">
                <div class="px-4">
                    <span class="text-xs font-semibold text-gray-300 uppercase tracking-wider">CAMPUS HEALTH</span>
                </div>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('pasien.create') }}"
                    class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'pasien.create' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                    <span class="text-sm">Patient Form</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('peminjaman-alat.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Str::startsWith(Route::currentRouteName(), 'peminjaman-alat.') ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                    <span class="text-sm">Equipment Borrowing</span>
                </a>
            </li>
            @endif

            <!-- LOG OUT - Available for all users -->
            <li class="mb-1 group">
                <a href="{{ route('home') }}"
                        class="flex items-center py-2 px-4 hover:bg-gray-400 hover:text-gray-100 rounded-md {{ Route::currentRouteName() === 'home' ? 'bg-gray-300 text-black' : 'text-gray-300' }}">
                    <span class="text-sm">Back To Home</span>
                </a>
            </li>
            @auth
            <li class="mb-1 group mt-6">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full py-2 px-4 bg-gray-300 text-black hover:bg-gray-400 rounded-md flex items-center justify-center">
                        <span class="text-sm">Log Out</span>
                    </button>
                </form>
            </li>
            @endauth

        </ul>
    </div>
</div>

<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>

<style>
    /* Custom Scrollbar Styling */
    .sidebar-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-scrollbar::-webkit-scrollbar-track {
        background: rgba(4, 140, 106, 0.1);
        border-radius: 3px;
    }

    .sidebar-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Accordion Animation */
    .sidebar-accordion[open] .ri-arrow-down-s-line {
        transform: rotate(180deg);
    }

    /* Hide default details marker */
    .sidebar-accordion > summary {
        list-style: none;
    }
    .sidebar-accordion > summary::-webkit-details-marker {
        display: none;
    }

    /* Accordion summary styling */
    .sidebar-accordion > summary {
        font-weight: 600;
    }
    
    .sidebar-accordion summary.bg-gradient-to-r::before {
        content: '';
        position: absolute;
        top: 2px;
        right: 2px;
        width: 6px;
        height: 6px;
        background-color: #fbbf24;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
</style>

<script>
    // Accordion functionality
    document.addEventListener('DOMContentLoaded', function() {
        const accordions = document.querySelectorAll('.sidebar-accordion');
        
        accordions.forEach(accordion => {
            accordion.addEventListener('toggle', function() {
                const icon = this.querySelector('.ri-arrow-down-s-line');
                if (this.open) {
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                }
            });
        });
    });
</script>