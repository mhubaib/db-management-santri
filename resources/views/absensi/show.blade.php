@extends('layouts.app')
@section('title', 'Detail Absensi')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Detail Absensi</h2>
            </div>
            <div class="mb-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Santri</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->santri->nama }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->kelas->nama_kelas }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tingkatan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->kelas->tingkatan }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->tanggal->format('d-m-Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sesi</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $absensi->jadwal->jam_mulai }} s/d {{ $absensi->jadwal->jam_selesai }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Pelajaran</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->jadwal->pelajaran->nama_pelajaran }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $absensi->status }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $absensi->keterangan ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('absensi.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Kembali</a>
                <a href="{{ route('absensi.edit', $absensi->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors duration-300">Edit</a>
            </div>
        </div>
    </div>
@endsection
