<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'UMN Medical Center')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Reset semua scrollbar default */
        * {
            scrollbar-width: none;
        }
        
        *::-webkit-scrollbar {
            display: none;
        }
        
        /* Styling dasar */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #effaf5;
            color: #144034;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        /* Animations */
        @keyframes slide-in-right {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slide-out-right {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            14% { transform: scale(1.18); }
            28% { transform: scale(1); }
            42% { transform: scale(1.18); }
            70% { transform: scale(1); }
        }
        
        /* Utility Classes */
        .animate-slide-in-right {
            animation: slide-in-right 0.3s ease-out forwards;
        }
        
        .animate-slide-out-right {
            animation: slide-out-right 0.3s ease-out forwards;
        }
        
        .animate-heartbeat {
            animation: heartbeat 1.5s infinite;
            transform-origin: center;
        }
        
        .shadow-glow {
            box-shadow: 0 0 20px rgba(83, 180, 144, 0.5);
        }
        
        /* Desktop Navigation */
        .nav-link {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            font-weight: 700;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: white;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }
        
        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .nav-link:hover {
            transform: translateY(-2px);
        }
        
        /* Mobile Navigation */
        .nav-link-mobile {
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link-mobile:hover {
            background-color: #d1fae5 !important;
            transform: translateX(5px);
            box-shadow: 2px 0 10px rgba(5, 150, 105, 0.2);
        }
        
        /* Buttons */
        .btn-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-weight: 700;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .btn-hover:active {
            transform: translateY(0);
        }
        
        /* Alive Button Special */
        .alive-btn {
            background-color: #FFFFF2 !important;
            color: #4F352F !important;
            border: 2px solid #4F352F !important;
            transition: all 0.3s ease;
        }
        
        .alive-btn:hover {
            background-color: #FFD700 !important;
            color: #4F352F !important;
            border-color: #4F352F !important;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.7) !important;
        }
        
        /* Logo Effects */
        .rotating-logo {
            will-change: transform;
            transition: transform 0.6s cubic-bezier(0.25, 0.1, 0.25, 1);
        }
        
        /* Dropdowns */
        .dropdown-content {
            transition: opacity 0.2s ease, transform 0.2s ease;
            transform-origin: top right;
        }
        
        .dropdown-open {
            opacity: 1;
            transform: scale(1) translateY(0);
            display: block !important;
        }
        
        .dropdown-closed {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }

        /* Custom Scrollbar Container - Desktop Only */
        @media (min-width: 1024px) {
            /* Custom scrollbar untuk body saja */
            body {
                overflow-y: scroll;
            }
            
            body::-webkit-scrollbar {
                width: 12px;
                background: transparent;
            }
            
            body::-webkit-scrollbar-track {
                background: transparent;
                margin-top: 80px;
                margin-bottom: 60px;
            }
            
            body::-webkit-scrollbar-thumb {
                background-color: rgba(20, 64, 52, 0.6);
                border-radius: 9999px;
                border: 3px solid transparent;
                background-clip: content-box;
            }
            
            body::-webkit-scrollbar-thumb:hover {
                background-color: rgba(20, 64, 52, 0.8);
            }
            
            /* Untuk Firefox */
            body {
                scrollbar-width: thin;
                scrollbar-color: rgba(20, 64, 52, 0.6) transparent;
            }
        }

        /* Scrollbar untuk konten internal tetap hidden */
        .overflow-y-auto::-webkit-scrollbar,
        .overflow-auto::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="relative bg-[#effaf5] text-[#144034] font-roboto min-h-screen flex flex-col">
    
    <!-- Header -->
    @include('components.header')
    
    <!-- Main Content -->
    <main class="flex-grow w-full pt-20 lg:pt-12">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Script -->
    <script>
        // DOM Elements
        const menuButton = document.getElementById('menuButton');
        const sidebarMenu = document.getElementById('sidebarMenu');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');
        const logo = document.getElementById('logo');

        // Sidebar Functionality
        if (menuButton && sidebarMenu && closeSidebar && overlay) {
            menuButton.addEventListener('click', () => {
                sidebarMenu.classList.remove('hidden', 'translate-x-full', 'animate-slide-out-right');
                sidebarMenu.classList.add('animate-slide-in-right');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });

            closeSidebar.addEventListener('click', () => {
                sidebarMenu.classList.remove('animate-slide-in-right');
                sidebarMenu.classList.add('animate-slide-out-right');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
                setTimeout(() => {
                    sidebarMenu.classList.add('translate-x-full');
                }, 300);
            });

            overlay.addEventListener('click', () => {
                closeSidebar.click();
            });
        }

        // Generic Dropdown Handler
        function setupDropdown(dropdownId, buttonId) {
            const dropdownContainer = document.getElementById(dropdownId);
            if (dropdownContainer) {
                const button = document.getElementById(buttonId);
                const dropdown = dropdownContainer.querySelector('.dropdown-content');
                let dropdownTimer;
                let isDropdownOpen = false;
                let isMouseInDropdown = false;

                const openDropdown = () => {
                    clearTimeout(dropdownTimer);
                    dropdown.classList.remove('hidden', 'dropdown-closed');
                    dropdown.classList.add('dropdown-open');
                    isDropdownOpen = true;
                };

                const closeDropdownWithDelay = () => {
                    clearTimeout(dropdownTimer);
                    dropdownTimer = setTimeout(() => {
                        if (!isMouseInDropdown) {
                            dropdown.classList.remove('dropdown-open');
                            dropdown.classList.add('dropdown-closed');
                            setTimeout(() => {
                                if (!isMouseInDropdown) {
                                    dropdown.classList.add('hidden');
                                }
                            }, 200);
                            isDropdownOpen = false;
                        }
                    }, 300);
                };

                // Event Listeners
                button.addEventListener('mouseenter', openDropdown);
                button.addEventListener('mouseleave', closeDropdownWithDelay);
                
                dropdown.addEventListener('mouseenter', () => {
                    isMouseInDropdown = true;
                    clearTimeout(dropdownTimer);
                });

                dropdown.addEventListener('mouseleave', () => {
                    isMouseInDropdown = false;
                    closeDropdownWithDelay();
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (isDropdownOpen && 
                        !dropdownContainer.contains(e.target) && 
                        !button.contains(e.target)) {
                        dropdown.classList.remove('dropdown-open');
                        dropdown.classList.add('dropdown-closed');
                        setTimeout(() => {
                            dropdown.classList.add('hidden');
                        }, 200);
                        isDropdownOpen = false;
                    }
                });
            }
        }

        // Setup More Dropdown
        setupDropdown('moreDropdownContainer', 'moreButton');

        // Optimized Logo Rotation
        if (logo) {
            let scrollAnimationFrame = null;
            let lastScrollY = window.scrollY;
            let rotation = 0;
            const rotationSpeed = 0.5;

            function updateLogoRotation() {
                const scrollDelta = window.scrollY - lastScrollY;
                rotation += scrollDelta * rotationSpeed;
                
                // Clamp rotation to reasonable limits
                rotation = Math.max(-180, Math.min(180, rotation));
                
                logo.style.transform = `rotate(${rotation}deg)`;
                lastScrollY = window.scrollY;
                scrollAnimationFrame = null;
            }

            function handleScroll() {
                if (!scrollAnimationFrame) {
                    scrollAnimationFrame = requestAnimationFrame(updateLogoRotation);
                }
                
                // Reset rotation slowly when not scrolling
                clearTimeout(window.scrollResetTimeout);
                window.scrollResetTimeout = setTimeout(() => {
                    const resetRotation = () => {
                        if (Math.abs(rotation) > 0.5) {
                            rotation *= 0.95; // Smooth decay
                            logo.style.transform = `rotate(${rotation}deg)`;
                            requestAnimationFrame(resetRotation);
                        }
                    };
                    resetRotation();
                }, 150);
            }

            window.addEventListener('scroll', handleScroll, { passive: true });
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (sidebarMenu && menuButton && 
                !sidebarMenu.contains(e.target) && 
                !menuButton.contains(e.target) && 
                !sidebarMenu.classList.contains('translate-x-full')) {
                closeSidebar.click();
            }
        });

        // Close dropdowns when pressing Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.dropdown-open').forEach(dropdown => {
                    dropdown.classList.remove('dropdown-open');
                    dropdown.classList.add('dropdown-closed');
                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 200);
                });
                
                if (sidebarMenu && !sidebarMenu.classList.contains('translate-x-full')) {
                    closeSidebar.click();
                }
            }
        });

        // Force scrollbar styling for Edge/IE
        function applyScrollbarStyling() {
            // Deteksi browser
            const isIE = /*@cc_on!@*/false || !!document.documentMode;
            const isEdge = !isIE && !!window.StyleMedia;
            
            if (isEdge || isIE) {
                // Tambahkan styling khusus untuk Edge/IE
                const style = document.createElement('style');
                style.textContent = `
                    @media (min-width: 1024px) {
                        body {
                            -ms-overflow-style: -ms-autohiding-scrollbar;
                        }
                    }
                `;
                document.head.appendChild(style);
            }
        }

        // Apply scrollbar styling setelah DOM siap
        document.addEventListener('DOMContentLoaded', applyScrollbarStyling);
    </script>
    
    @stack('scripts')
</body>
</html>