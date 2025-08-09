<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/style.css">
    <title>{{ $title }} | UMN Medical Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Bitter', serif;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body class="text-black bg-[#effaf5]">

    <!-- start: Sidebar -->
    @include('components.sidebar')
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="w-full bg-gray-50 min-h-screen transition-all main">

        <!-- Header -->
        <div class="py-2 px-6 bg-gradient-to-r from-[#048C6A] to-[#144034] flex items-center shadow-lg sticky top-0 left-0 z-[999]">
            <!-- Hamburger -->
            <button type="button" class="text-2xl text-white sidebar-toggle transform transition-transform duration-200 hover:scale-110">
                <i class="ri-menu-line"></i>
            </button>

            <ul class="ml-auto flex items-center">
                <!-- Notifikasi -->
                <li class="dropdown mr-4">
                    <button type="button"
                        class="dropdown-toggle text-white text-xl w-9 h-9 rounded flex items-center justify-center transform transition-transform duration-200 hover:scale-110 relative">
                        <i class="ri-notification-3-line"></i>
                        @if(isset($notification) && count($notification) > 0)
                            <div class="rounded-full h-4 w-4 bg-red-600 absolute top-0 right-0 text-[10px] text-white flex items-center justify-center leading-none">
                                {{ count($notification) }}
                            </div>
                        @endif
                    </button>

                    <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-40 w-full bg-white rounded-md border border-gray-100">
                        <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                            <button type="button" data-tab="notification" data-tab-page="notifications"
                                class="text-gray-400 font-medium text-[13px] border-b-2 border-b-transparent mr-4 pb-1 active">Notifications</button>
                        </div>
                        <div class="my-2">
                            <ul class="max-h-64 overflow-y-auto" data-tab-for="notification" data-page="notifications">
                                @if(isset($pendings) && count($pendings) > 0)
                                    @foreach ($pendings as $pending)
                                        <li>
                                            <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                                <div class="ml-2">
                                                    <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                                                        New Request!
                                                    </div>
                                                    <div class="text-[11px] text-gray-400">from {{ $pending->organization }}</div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>

                <!-- Nama Pengguna -->
                <li>
                    <h3 class="font-bold text-white text-base transform transition-transform duration-200 hover:scale-110 ml-4">
                        {{ Auth::user()->first_name }}
                    </h3>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        @yield('content')

        <!-- Footer -->
        @include('components.footer')
    </main>
    <!-- end: Main -->

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>

    <script>
        // start: Sidebar
        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        const main = document.querySelector('.main')
        const sidebarCloseBtn = document.querySelector('.sidebar-close');

        if (window.innerWidth < 768) {
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
        }

        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })

        sidebarOverlay.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')
        })

        sidebarCloseBtn.addEventListener('click', function () {
            sidebarMenu.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
        
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault()
                const parent = item.closest('.group')
                if (parent.classList.contains('selected')) {
                    parent.classList.remove('selected')
                } else {
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                        i.closest('.group').classList.remove('selected')
                    })
                    parent.classList.add('selected')
                }
            })
        })
        // end: Sidebar

        document.addEventListener('DOMContentLoaded', function () {
            const greetingElement = document.getElementById('greeting');
            const currentHour = new Date().getHours();
            let greetingText;

            if (currentHour >= 5 && currentHour < 12) {
                greetingText = 'Good Morning,';
            } else if (currentHour >= 12 && currentHour <= 15) {
                greetingText = 'Good Afternoon,';
            } else if (currentHour >= 16 && currentHour <= 18) {
                greetingText = 'Good Evening,';
            } else {
                greetingText = 'Good Night,';
            }

            greetingElement.textContent = greetingText;
        });

        // start: Popper
        const popperInstance = {}
        document.querySelectorAll('.dropdown').forEach(function (item, index) {
            const popperId = 'popper-' + index
            const toggle = item.querySelector('.dropdown-toggle')
            const menu = item.querySelector('.dropdown-menu')
            menu.dataset.popperId = popperId
            popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 24,
                        },
                    },
                ],
                placement: 'bottom-end'
            });
        })

        document.addEventListener('click', function (e) {
            const toggle = e.target.closest('.dropdown-toggle')
            const menu = e.target.closest('.dropdown-menu')
            if (toggle) {
                const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
                const popperId = menuEl.dataset.popperId
                if (menuEl.classList.contains('hidden')) {
                    hideDropdown()
                    menuEl.classList.remove('hidden')
                    showPopper(popperId)
                } else {
                    menuEl.classList.add('hidden')
                    hidePopper(popperId)
                }
            } else if (!menu) {
                hideDropdown()
            }
        })

        function hideDropdown() {
            document.querySelectorAll('.dropdown-menu').forEach(function (item) {
                item.classList.add('hidden')
            })
        }

        function showPopper(popperId) {
            popperInstance[popperId].setOptions(function (options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: 'eventListeners', enabled: true },
                    ],
                }
            });
            popperInstance[popperId].update();
        }

        function hidePopper(popperId) {
            popperInstance[popperId].setOptions(function (options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: 'eventListeners', enabled: false },
                    ],
                }
            });
        }
        // end: Popper

        // start: Tab
        document.querySelectorAll('[data-tab]').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault()
                const tab = item.dataset.tab
                const page = item.dataset.tabPage
                const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page + '"]')
                document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function (i) {
                    i.classList.remove('active')
                })
                document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function (i) {
                    i.classList.add('hidden')
                })
                item.classList.add('active')
                target.classList.remove('hidden')
            })
        })
        // end: Tab
    </script>

    @stack('scripts')
</body>
</html>