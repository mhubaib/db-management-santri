@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="bg-white overflow-hidden shadow-xl rounded-lg border border-gray-100">
        <div class="px-8 py-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary-800">Daftar Kelas</h2>
                <a href="{{ route('kelas.create') }}"
                    class="px-5 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-300 flex items-center gap-2 font-medium shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Kelas
                </a>
            </div>

            <!-- Search and Filter Section -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                <form action="{{ route('kelas.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow flex overflow-hidden rounded-lg border border-gray-200">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="search"
                            class="bg-white text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 border-none rounded-none"
                            placeholder="Cari kelas..." value="{{ request('search') }}" />
                        <button type="submit" name="search_btn"
                            class="px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-800 transition-all duration-100 flex items-center gap-2 font-medium shadow-sm border-none rounded-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                            Cari
                        </button>
                    </div>
                    <div class="flex gap-3 flex-wrap sm:flex-nowrap">
                        <select name="tingkatan"
                            class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5">
                            <option value="">Semua Tingkatan</option>
                            @foreach ($kelas->pluck('tingkatan')->unique() as $tingkatan)
                            <option value="{{ $tingkatan }}" {{ request('tingkatan') == $tingkatan ? 'selected' : '' }}>
                                {{ $tingkatan }}
                            </option>   
                            @endforeach
                        </select>
                        <button type="submit" name="filter" id="filterButton"
                            class="px-4 py-2.5 bg-secondary-400 text-white rounded-lg transition-all duration-300 flex items-center gap-2 font-medium shadow-sm opacity-50 cursor-not-allowed"
                            disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter
                        </button>

                        @if (request()->anyFilled(['search', 'tingkatan']))
                            <a href="{{ route('kelas.index') }}"
                                class="px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 flex items-center gap-2 font-medium shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                                No</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Kelas</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tingkatan</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($kelas as $index => $kls)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-700">
                                    {{ $kls->nama_kelas }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ ucfirst($kls->tingkatan) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('kelas.show', $kls->id) }}"
                                            class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors duration-200"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('kelas.edit', $kls->id) }}"
                                            class="p-1.5 text-yellow-600 hover:bg-yellow-50 rounded transition-colors duration-200"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('kelas.destroy', $kls->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center bg-gray-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="font-medium">Tidak ada data kelas</p>
                                        <p class="text-gray-400 mt-1">Silahkan tambahkan data kelas terlebih dahulu</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @push('styles')
                <style>
                    .pagination {
                        @apply flex justify-center mt-4 gap-1;
                    }

                    .pagination>* {
                        @apply px-3 py-1 text-sm font-medium bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-md;
                    }

                    .pagination .active {
                        @apply bg-primary-600 text-white border-primary-600 hover:bg-primary-700;
                    }

                    .pagination .disabled {
                        @apply opacity-50 cursor-not-allowed;
                    }
                </style>
            @endpush
            {{-- @if ($kelas->hasPages())
                <div class="px-6 py-4 bg-white border-t border-gray-200">
                    {{ $kelas->withQueryString()->links() }}
                </div>
            @endif --}}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterTingkatan = document.querySelector('select[name="tingkatan"]');
                const filterButton = document.getElementById('filterButton');

                const allFilters = [filterTingkatan];

                function checkFilters() {
                    const hasActiveFilter = allFilters.some(filter => filter.value !== "");

                    if (hasActiveFilter) {
                        filterButton.classList.remove('bg-secondary-400', 'cursor-not-allowed', 'opacity-50');
                        filterButton.classList.add('bg-primary-600', 'hover:bg-primary-800', 'cursor-pointer');
                        filterButton.disabled = false;
                    } else {
                        filterButton.classList.remove('bg-primary-600', 'hover:bg-primary-800', 'cursor-pointer');
                        filterButton.classList.add('bg-secondary-400', 'cursor-not-allowed', 'opacity-50');
                        filterButton.disabled = true
                    }
                }

                allFilters.forEach(filter => {
                    if (filter) {
                        filter.addEventListener('change', checkFilters);
                    }
                });

                checkFilters();
            })
        </script>
    @endpush
@endsection
