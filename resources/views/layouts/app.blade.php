<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Pondok - @yield('title')</title>
    @vite('resources/css/app.css')
    <style>
        .logout-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .logout-btn:hover::before {
            left: 100%;
        }

        .logout-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidebar-collapsed {
            width: 4rem !important;
            overflow-x: hidden;
        }

        .sidebar-expanded {
            width: 16rem !important;
        }

        .main-content-collapsed {
            padding-left: 4rem !important;
        }

        .main-content-expanded {
            padding-left: 16rem !important;
        }

        @media (max-width: 1023px) {
            .main-content-collapsed,
            .main-content-expanded {
                padding-left: 0 !important;
            }

            .mobile-hamburger {
                display: flex !important;
                visibility: visible !important;
            }

            .hamburger-btn.sidebar {
                display: none;
            }
        }

        @media (min-width: 1024px) {
            .mobile-hamburger {
                display: none !important;
            }

            .hamburger-btn.sidebar {
                display: flex;
            }
        }

        .sidebar-collapsed .nav-text,
        .sidebar-collapsed .sidebar-title {
            opacity: 0;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
            display: none !important;
        }

        .sidebar-expanded .nav-text,
        .sidebar-expanded .sidebar-title {
            opacity: 1;
            width: auto;
        }

        .sidebar-collapsed .nav-link {
            justify-content: center !important;
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }

        .sidebar-collapsed .nav-link svg {
            margin-right: 0 !important;
        }

        .sidebar-collapsed .sidebar-header {
            justify-content: center !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .sidebar-header {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            min-height: 4rem !important;
            padding: 0 1.5rem !important;
            gap: 1rem !important;
        }

        .sidebar-title {
            flex: 1 !important;
            min-width: 0 !important;
            transition: all 0.3s ease !important;
        }

        .sidebar-collapsed {
            overflow-x: hidden !important;
        }

        .sidebar-collapsed .nav-container {
            overflow-x: hidden !important;
        }

        .hamburger-btn {
            transition: all 0.3s ease;
            flex-shrink: 0;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hamburger-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .hamburger-icon {
            transition: all 0.3s ease;
            width: 1.5rem;
            height: 1.5rem;
        }

        .hamburger-icon.active .line1 {
            transform: rotate(45deg) translate(4px, 4px);
        }

        .hamburger-icon.active .line2 {
            opacity: 0;
        }

        .hamburger-icon.active .line3 {
            transform: rotate(-45deg) translate(4px, -4px);
        }

        .hamburger-icon .hamburger-line {
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .nav-text,
        .sidebar-title {
            transition: all 0.3s ease;
            overflow: hidden;
        }
    </style>
</head>

<body class="h-full">
    <div class="min-h-full">
        <!-- Sidebar overlay for mobile -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-gray-600 bg-opacity-75 z-20 lg:hidden hidden transition-opacity duration-300"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 sidebar-expanded transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out bg-primary-700 z-30 flex flex-col">
            <div class="sidebar-header bg-primary-800">
                <h1 class="sidebar-title text-xl font-bold text-white">Informasi Pondok</h1>
                <button id="toggle-sidebar-header"
                    class="hamburger-btn sidebar text-white rounded-md hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-white transition-all duration-200">
                    <div class="hamburger-icon flex flex-col justify-center items-center">
                        <span class="hamburger-line line1 block w-5 h-0.5 bg-white mb-1"></span>
                        <span class="hamburger-line line2 block w-5 h-0.5 bg-white mb-1"></span>
                        <span class="hamburger-line line3 block w-5 h-0.5 bg-white"></span>
                    </div>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto py-4 px-3 nav-container">
                <nav class="space-y-1">
                    <a href="{{ route('santri.index') }}"
                        class="nav-link {{ request()->routeIs('santri.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="nav-text">Data Santri</span>
                    </a>
                    <a href="{{ route('ustadz.index') }}"
                        class="nav-link {{ request()->routeIs('ustadz.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="nav-text">Data Ustadz</span>
                    </a>
                    <a href="{{ route('pelajaran.index') }}"
                        class="nav-link {{ request()->routeIs('pelajaran.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="nav-text">Data Pelajaran</span>
                    </a>
                    <a href="{{ route('jadwal.index') }}"
                        class="nav-link {{ request()->routeIs('jadwal.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="nav-text">Data Jadwal</span>
                    </a>
                    <a href="{{ route('absensi.index') }}"
                        class="nav-link {{ request()->routeIs('absensi.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H12 4a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="nav-text">Data Absensi</span>
                    </a>
                    <a href="{{ route('kamar.index') }}"
                        class="nav-link {{ request()->routeIs('kamar.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="nav-text">Data Kamar</span>
                    </a>
                    <a href="{{ route('kelas.index') }}"
                        class="nav-link {{ request()->routeIs('kelas.*') ? 'bg-primary-800 text-white' : 'text-white hover:bg-primary-600' }} flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors duration-200 group">
                        <svg class="h-5 w-5 flex-shrink-0 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="nav-text">Data Kelas</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main content -->
        <div id="main-content" class="main-content-expanded flex flex-col min-h-full transition-all duration-300">
            <nav class="bg-primary-600 shadow-lg">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button id="toggle-sidebar-mobile"
                                class="mobile-hamburger hamburger-btn text-white rounded-md hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-white transition-all duration-200">
                                <div class="hamburger-icon flex flex-col justify-center items-center">
                                    <span class="hamburger-line line1 block w-5 h-0.5 bg-white mb-1"></span>
                                    <span class="hamburger-line line2 block w-5 h-0.5 bg-white mb-1"></span>
                                    <span class="hamburger-line line3 block w-5 h-0.5 bg-white"></span>
                                </div>
                            </button>
                            <h2 class="text-xl font-semibold text-white">
                                @if (request()->routeIs('santri.*'))
                                    Data Santri
                                @elseif(request()->routeIs('ustadz.*'))
                                    Data Ustadz
                                @elseif(request()->routeIs('pelajaran.*'))
                                    Data Pelajaran
                                @elseif(request()->routeIs('jadwal.*'))
                                    Data Jadwal
                                @elseif(request()->routeIs('absensi.*'))
                                    Data Absensi
                                @elseif(request()->routeIs('kamar.*'))
                                    Data Kamar
                                @elseif(request()->routeIs('kelas.*'))
                                    Data Kelas
                                @else
                                    Dashboard
                                @endif
                            </h2>
                        </div>
                        <div class="flex items-center">
                            <form method="POST" action="logout" class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="logout-btn inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 focus:ring-offset-primary-600 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                <div id="loading"
                    class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                    <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-primary-500"></div>
                </div>
                @if (session('success'))
                    <div class="mb-4 rounded-md bg-green-50 p-4 animate-fade-in" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button"
                                        class="alert-close inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 transition-colors duration-200">
                                        <span class="sr-only">Dismiss</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="animate-slide-in">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const toggleSidebarHeaderBtn = document.getElementById('toggle-sidebar-header');
            const toggleSidebarMobileBtn = document.getElementById('toggle-sidebar-mobile');
            const mainContent = document.getElementById('main-content');
            const alertCloseButtons = document.querySelectorAll('.alert-close');
            let sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            // Initialize hamburger icons based on saved state and screen size
            function updateHamburgerIcons(isSidebarVisible) {
                const hamburgerIcons = document.querySelectorAll('.hamburger-icon');
                hamburgerIcons.forEach(icon => {
                    icon.classList.toggle('active', isSidebarVisible);
                });
            }

            function collapseSidebar() {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('main-content-expanded');
                mainContent.classList.add('main-content-collapsed');
                sidebarCollapsed = true;
                localStorage.setItem('sidebarCollapsed', 'true');
                updateHamburgerIcons(false);
            }

            function expandSidebar() {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                mainContent.classList.remove('main-content-collapsed');
                mainContent.classList.add('main-content-expanded');
                sidebarCollapsed = false;
                localStorage.setItem('sidebarCollapsed', 'false');
                updateHamburgerIcons(true);
            }

            function toggleSidebarMobile(visible) {
                if (visible) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                    setTimeout(() => sidebarOverlay.classList.add('opacity-100'), 10);
                    updateHamburgerIcons(true);
                    // Ensure mobile hamburger remains visible
                    toggleSidebarMobileBtn.style.display = 'flex';
                    toggleSidebarMobileBtn.style.visibility = 'visible';
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.remove('opacity-100');
                    setTimeout(() => sidebarOverlay.classList.add('hidden'), 300);
                    updateHamburgerIcons(false);
                    // Ensure mobile hamburger remains visible
                    toggleSidebarMobileBtn.style.display = 'flex';
                    toggleSidebarMobileBtn.style.visibility = 'visible';
                }
            }

            function toggleSidebarAll() {
                if (window.innerWidth >= 1024) {
                    if (sidebarCollapsed) {
                        expandSidebar();
                    } else {
                        collapseSidebar();
                    }
                } else {
                    const isVisible = !sidebar.classList.contains('-translate-x-full');
                    toggleSidebarMobile(!isVisible);
                }
            }

            function handleResize() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                    sidebarOverlay.classList.remove('opacity-100');
                    if (sidebarCollapsed) {
                        collapseSidebar();
                    } else {
                        expandSidebar();
                    }
                    toggleSidebarMobileBtn.style.display = 'none';
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('sidebar-collapsed');
                    sidebar.classList.add('sidebar-expanded');
                    mainContent.classList.remove('main-content-collapsed', 'main-content-expanded');
                    sidebarOverlay.classList.add('hidden');
                    sidebarOverlay.classList.remove('opacity-100');
                    updateHamburgerIcons(false);
                    toggleSidebarMobileBtn.style.display = 'flex';
                    toggleSidebarMobileBtn.style.visibility = 'visible';
                }
            }

            toggleSidebarHeaderBtn.addEventListener('click', toggleSidebarAll);
            toggleSidebarMobileBtn.addEventListener('click', toggleSidebarAll);
            sidebarOverlay.addEventListener('click', () => {
                toggleSidebarMobile(false);
            });

            window.addEventListener('resize', handleResize);

            alertCloseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const alert = this.closest('[role="alert"]');
                    alert.classList.add('opacity-0');
                    setTimeout(() => alert.remove(), 300);
                });
            });

            const logoutBtn = document.querySelector('.logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin logout?')) {
                        e.preventDefault();
                    }
                });
            }

            handleResize();
        });
    </script>
    @stack('scripts')
</body>

</html>     