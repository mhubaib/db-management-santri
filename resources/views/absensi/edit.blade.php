@extends('layouts.app')
@section('title', 'Edit Absensi')
@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit Absensi</h2>
            </div>
            <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="santri_id" class="block text-sm font-medium text-gray-700">Santri</label>
                        <select name="santri_id" id="santri_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Pilih Santri</option>
                            @foreach ($santris as $santri)
                                <option value="{{ $santri->id }}"
                                    {{ old('santri_id', $absensi->santri_id) == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama }}</option>
                            @endforeach
                        </select>
                        @error('santri_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jadwal_id" class="block text-sm font-medium text-gray-700">Jadwal</label>
                        <select name="jadwal_id" id="jadwal_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Pilih Jadwal</option>
                            @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}"
                                    {{ old('jadwal_id', $absensi->jadwal_id) == $jadwal->id ? 'selected' : '' }}>
                                    {{ $jadwal->hari }} - {{ $jadwal->jam_mulai }} s/d {{ $jadwal->jam_selesai }} -
                                    {{ $jadwal->pelajaran->nama_pelajaran ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('jadwal_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Pilih Status</option>
                            <option value="hadir" {{ old('status', $absensi->status) == 'hadir' ? 'selected' : '' }}>Hadir
                            </option>
                            <option value="izin" {{ old('status', $absensi->status) == 'izin' ? 'selected' : '' }}>Izin
                            </option>
                            <option value="sakit" {{ old('status', $absensi->status) == 'sakit' ? 'selected' : '' }}>Sakit
                            </option>
                            <option value="alpa" {{ old('status', $absensi->status) == 'alpa' ? 'selected' : '' }}>Alpa
                            </option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('keterangan', $absensi->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('absensi.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Batal</a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
