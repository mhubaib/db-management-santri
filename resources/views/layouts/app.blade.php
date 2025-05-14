<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Pondok - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-primary-600 shadow-lg">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-xl font-bold text-white">Management Pondok</h1>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="{{ route('santri.index') }}" 
                                   class="{{ request()->routeIs('santri.*') ? 'bg-primary-700 text-white' : 'text-white hover:bg-primary-500' }} 
                                   rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                    Data Santri
                                </a>
                                <a href="{{ route('ustadz.index') }}" 
                                   class="{{ request()->routeIs('ustadz.*') ? 'bg-primary-700 text-white' : 'text-white hover:bg-primary-500' }}
                                   rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                    Data Ustadz
                                </a>
                                <a href="{{ route('pelajaran.index') }}" 
                                   class="{{ request()->routeIs('pelajaran.*') ? 'bg-primary-700 text-white' : 'text-white hover:bg-primary-500' }}
                                   rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                    Data Pelajaran
                                </a>
                                <a href="{{ route('jadwal.index') }}" 
                                   class="{{ request()->routeIs('jadwal.*') ? 'bg-primary-700 text-white' : 'text-white hover:bg-primary-500' }}
                                   rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                    Jadwal
                                </a>
                                <a href="{{ route('absensi.index') }}" 
                                   class="{{ request()->routeIs('absensi.*') ? 'bg-primary-700 text-white' : 'text-white hover:bg-primary-500' }}
                                   rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                                    Absensi
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex md:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center rounded-md bg-primary-700 p-2 text-white hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-800">
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state -->
            <div class="mobile-menu hidden md:hidden">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <a href="{{ route('santri.index') }}" class="{{ request()->routeIs('santri.*') ? 'bg-primary-700' : '' }} text-white block rounded-md px-3 py-2 text-base font-medium">Data Santri</a>
                    <a href="{{ route('ustadz.index') }}" class="{{ request()->routeIs('ustadz.*') ? 'bg-primary-700' : '' }} text-white block rounded-md px-3 py-2 text-base font-medium">Data Ustadz</a>
                    <a href="{{ route('pelajaran.index') }}" class="{{ request()->routeIs('pelajaran.*') ? 'bg-primary-700' : '' }} text-white block rounded-md px-3 py-2 text-base font-medium">Data Pelajaran</a>
                    <a href="{{ route('jadwal.index') }}" class="{{ request()->routeIs('jadwal.*') ? 'bg-primary-700' : '' }} text-white block rounded-md px-3 py-2 text-base font-medium">Jadwal</a>
                    <a href="{{ route('absensi.index') }}" class="{{ request()->routeIs('absensi.*') ? 'bg-primary-700' : '' }} text-white block rounded-md px-3 py-2 text-base font-medium">Absensi</a>
                </div>
            </div>
        </nav>

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <!-- Loading State -->
            <div id="loading" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-primary-500"></div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-4 animate-fade-in" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" class="alert-close inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
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

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });

        // Alert close button
        document.querySelectorAll('.alert-close').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('[role="alert"]').remove();
            });
        });

        // Loading state management
        window.showLoading = function() {
            document.getElementById('loading').classList.remove('hidden');
        };

        window.hideLoading = function() {
            document.getElementById('loading').classList.add('hidden');
        };

        // Add loading state to form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                showLoading();
            });
        });
    </script>
</body>
</html>