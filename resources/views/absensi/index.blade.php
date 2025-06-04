@extends('layouts.app')

@section('title', 'Daftar Absensi')

@section('content')
    <div class="bg-white overflow-hidden shadow-xl rounded-lg border border-gray-100">
        <div class="px-8 py-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary-800">Daftar Absensi</h2>
                <a href="{{ route('absensi.create') }}"
                    class="px-5 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-300 flex items-center gap-2 font-medium shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Absensi
                </a>
            </div>
            <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                <form action="{{ route('absensi.index') }}" method="GET" class="flex flex-col gap-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <select name="status"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Pilih Status</option>
                                <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alpa" {{ request('status') == 'alpa' ? 'selected' : '' }}>Alpha</option>
                                <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat
                                </option>
                            </select>
                        </div>
                        <div>
                            <select name="pelajaran"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Pilih Pelajaran</option>
                                @foreach ($pelajarans as $id => $nama)
                                    <option value="{{ $id }}" {{ request('pelajaran') == $id ? 'selected' : '' }}>
                                        {{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="date" name="tanggal" id="tanggal"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                value="{{ request('tanggal') ?? date('Y-m-d') }}">
                        </div>
                        <div>
                            <select name="waktu"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Pilih Waktu</option>
                                @foreach ($waktuJadwal as $waktu)
                                    <option value="{{ $waktu }}"
                                        {{ request('waktu') == $waktu ? 'selected' : '' }}>{{ $waktu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="tingkatan"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Pilih Tingkatan</option>
                                @foreach ($tingkatan as $level)
                                    <option value="{{ $level }}" {{ request('tingkatan') == $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="kelas"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $id => $nama_kelas)
                                    <option value="{{ $id }}" {{ request('kelas') == $id ? 'selected' : '' }}>{{ $nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <!-- Terapkan Filter -->
                        <button type="submit" name="filter" id="filterButton"
                            class="px-4 py-2.5 text-white rounded-lg transition-all duration-100 flex items-center gap-2 font-medium shadow-sm bg-secondary-400 cursor-not-allowed opacity-50"
                            disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Terapkan Filter
                        </button>

                        <!-- Reset Button -->
                        <div id="resetButtonContainer" class="hidden">
                            <a href="{{ route('absensi.index') }}"
                                class="px-4 py-2.5 text-white rounded-lg transition-all duration-300 flex items-center gap-2 font-medium shadow-sm bg-secondary-600 hover:bg-secondary-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto">
                <!-- Tabel -->
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                                No</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Santri</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kelas</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tingkatan</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Sesi</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pelajaran</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Keterangan</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($absensis as $index => $absensi)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-700">
                                    {{ $absensi->santri->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $absensi->kelas->nama_kelas }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $absensi->kelas->tingkatan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $absensi->tanggal->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $absensi->jadwal->jam_mulai }} s/d {{ $absensi->jadwal->jam_selesai }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $absensi->jadwal->pelajaran->nama_pelajaran }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($absensi->status == 'hadir')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Hadir</span>
                                    @elseif($absensi->status == 'izin')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Izin</span>
                                    @elseif($absensi->status == 'sakit')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sakit</span>
                                    @elseif($absensi->status == 'terlambat')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-300 text-red-800">Terlambat</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Alpha</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate">
                                    {{ $absensi->keterangan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('absensi.show', $absensi->id) }}"
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
                                        <a href="{{ route('absensi.edit', $absensi->id) }}"
                                            class="p-1.5 text-yellow-600 hover:bg-yellow-50 rounded transition-colors duration-200"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST"
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
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8a1 1 0 00-1-1zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10"
                                    class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center bg-gray-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="font-medium">Tidak ada data absensi</p>
                                        <p class="text-gray-400 mt-1">Silahkan tambahkan data absensi terlebih dahulu</p>
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

            @if ($absensis->hasPages())
                <div class="px-6 py-4 bg-white border-t border-gray-200">
                    {{ $absensis->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set default date to today if not already set
            const tanggalInput = document.getElementById('tanggal');
            if (!tanggalInput.value) {
                const today = new Date();
                const formattedDate = today.toISOString().substr(0, 10);
                tanggalInput.value = formattedDate;
            }
        });
    </script>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.querySelector('select[name="status"]');
            const pelajaranFilter = document.querySelector('select[name="pelajaran"]');
            const tanggalFilter = document.querySelector('input[name="tanggal"]');

            const waktuFilter = document.querySelector('select[name="waktu"]');
            const kelasFilter = document.querySelector('select[name="kelas"]');
            const tingkatanFilter = document.querySelector('select[name="tingkatan"]');
            const filterButton = document.getElementById('filterButton');
            const resetButton = document.getElementById('resetButtonContainer');

            //Array dari semua filter
            const allFilters = [statusFilter, pelajaranFilter, tanggalFilter, waktuFilter, kelasFilter,
                tingkatanFilter
            ];

            // fungsi untuk memeriksa apakah ada filter yang dipilih
            function checkFilters() {
                const hasActiveFilter = allFilters.some(filter => filter.value !== '');

                if (hasActiveFilter) {
                    filterButton.classList.remove('bg-secondary-400', 'cursor-not-allowed', 'opacity-50');
                    filterButton.classList.add('bg-primary-600', 'hover:bg-primary-800', 'cursor-pointer');
                    filterButton.disabled = false;
                } else {
                    filterButton.classList.remove('bg-primary-600', 'hover:bg-primary-800', 'cursor-pointer');
                    filterButton.classList.add('bg-secondary-400', 'cursor-not-allowed', 'opacity-50');
                    filterButton.disabled = true;
                }
            }

            // event listener untuk setiap filter
            allFilters.forEach(filter => {
                if (filter) {
                    filter.addEventListener('change', checkFilters);
                }
            });

            // periksa status filter saat halaman dimuat
            checkFilters();

            // Tampilkan tombol reset jika ada parameter filter di URL
            const urlParams = new URLSearchParams(window.location.search);
            const hasFilterParams = ['status', 'pelajaran', 'tanggal', 'waktu', 'kelas', 'tingkatan'].some(param =>
                urlParams.has(param) && urlParams.get(param) !== '');

            if (hasFilterParams) {
                resetButton.classList.remove('hidden');
            } else {
                resetButton.classList.add('hidden');
            }
        });
    </script>
@endpush
