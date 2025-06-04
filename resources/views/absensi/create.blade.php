@extends('layouts.app')
@section('title', 'Tambah Absensi')
@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Absensi Baru</h2>
            </div>

            <!-- Filter Form -->
            <form action="{{ route('absensi.create') }}" method="GET" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ request('tanggal') ?? date('Y-m-d') }}">
                    </div>

                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select name="kelas" id="kelas"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Kelas</option>
                            @foreach ($kelas as $id => $nama)
                                <option value="{{ $id }}" {{ request('kelas') == $id ? 'selected' : '' }}>
                                    {{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tingkatan" class="block text-sm font-medium text-gray-700 mb-2">Tingkatan</label>
                        <select name="tingkatan" id="tingkatan"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Tingkatan</option>
                            @foreach ($tingkatan as $level)
                                <option value="{{ $level }}" {{ request('tingkatan') == $level ? 'selected' : '' }}>
                                    {{ ucfirst($level) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Buttons Row - Sejajar -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button type="submit" name="filter" value="1"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            Apply Absensi
                        </button>

                        <a href="{{ route('absensi.index') }}" 
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    </div>

                    @if (request()->has('filter'))
                        <a href="{{ route('absensi.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset Filter
                        </a>
                    @endif
                </div>
            </form>

            @if (request()->has('filter'))
                <!-- Absensi Form -->
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tanggal" value="{{ request('tanggal') }}">
                    <input type="hidden" name="tingkatan" value="{{ request('tingkatan') }}">
                    <input type="hidden" name="kelas_id" value="{{ request('kelas') }}">
                    <!-- Table -->
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        <input type="checkbox" id="select-all"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </th>
                                    <th scope="col" class="py-3 px-6">Nama Santri</th>
                                    <th scope="col" class="py-3 px-6">Nama Jadwal</th>
                                    <th scope="col" class="py-3 px-6">Status</th>
                                    <th scope="col" class="py-3 px-6">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($santris as $santri)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">
                                            <input type="checkbox" name="selected_santris[]" value="{{ $santri->id }}"
                                                class="santri-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        </td>
                                        <td class="py-4 px-6">{{ $santri->nama }}</td>
                                        <td class="py-4 px-6">
                                            <select name="jadwal_id[{{ $santri->id }}]"
                                                class="jadwal-select rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                                disabled>
                                                <option value="">Pilih Jadwal</option>
                                            </select>
                                        </td>
                                        <td class="py-4 px-6">
                                            <select name="status[{{ $santri->id }}]"
                                                class="status-select rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                                disabled>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="alpa">Alpa</option>
                                                <option value="terlambat">Terlambat</option>
                                            </select>
                                        </td>
                                        <td class="py-4 px-6">
                                            <input type="text" name="keterangan[{{ $santri->id }}]"
                                                class="keterangan-input rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                                disabled>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-6 text-center text-gray-500">
                                            Tidak ada data santri yang sesuai dengan filter
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('absensi.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Simpan
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-gray-50 p-6 text-center rounded-lg border border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Pilih Filter</h3>
                    <p class="mt-2 text-sm text-gray-500">Silakan pilih filter dan klik tombol "Tampilkan Data" untuk
                        menampilkan daftar santri</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('select-all');
                const santriCheckboxes = document.querySelectorAll('.santri-checkbox');

                if (!selectAll || santriCheckboxes.length === 0) return;

                const pelajaranSelects = document.querySelectorAll('.pelajaran-select');
                const jadwalSelects = document.querySelectorAll('.jadwal-select');
                const statusSelects = document.querySelectorAll('.status-select');
                const keteranganInputs = document.querySelectorAll('.keterangan-input');

                // Data sesi
                const allSesiData = @json($allSesiOptions);

                // Handle select all checkbox
                selectAll.addEventListener('change', function() {
                    const isChecked = selectAll.checked;
                    santriCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                        const row = checkbox.closest('tr');
                        enableRowInputs(row, isChecked);
                    });
                });

                // Handle individual checkboxes
                santriCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const row = checkbox.closest('tr');
                        enableRowInputs(row, checkbox.checked);
                        updateSelectAllState();
                        
                        // Populate sesi dropdown when checkbox is checked
                        if (checkbox.checked) {
                            const jadwalSelect = row.querySelector('.jadwal-select');
                            populateSesiDropdown(jadwalSelect);
                        }
                    });
                });

                // Populate sesi dropdown function
                function populateSesiDropdown(jadwalSelect) {
                    jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                    allSesiData.forEach(sesi => {
                        const option = document.createElement('option');
                        option.value = sesi.id;
                        option.textContent = sesi.text; // Akan menampilkan nama jadwal dan waktunya
                        jadwalSelect.appendChild(option);
                    });
                }

                // Enable/disable row inputs
                function enableRowInputs(row, enable) {
                    if (!row) return;

                    const inputs = row.querySelectorAll('select, input[type="text"]');
                    inputs.forEach(input => {
                        input.disabled = !enable;
                        if (enable) {
                            input.classList.remove('bg-gray-100');
                            input.classList.add('bg-white');
                            if (input.classList.contains('jadwal-select')) {
                                populateSesiDropdown(input);
                            }
                        } else {
                            input.classList.remove('bg-white');
                            input.classList.add('bg-gray-100');
                        }
                    });
                }

                // Update select all checkbox state
                function updateSelectAllState() {
                    const allChecked = Array.from(santriCheckboxes).every(checkbox => checkbox.checked);
                    const someChecked = Array.from(santriCheckboxes).some(checkbox => checkbox.checked);
                    selectAll.checked = allChecked;
                    selectAll.indeterminate = someChecked && !allChecked;
                }
            });
        </script>
    @endpush
@endsection