@extends('layouts.app')

@section('title', 'Detail Santri')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Detail Santri</h2>
            <div class="flex space-x-2">
                <a href="{{ route('santri.edit', $santri->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors duration-300">
                    Edit
                </a>
                <a href="{{ route('santri.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Nama Santri</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $santri->nama }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">NIS</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $santri->nis }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Kelas</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $santri->kelas->nama_kelas }} - {{ $santri->kelas->tingkatan }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Kamar</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $santri->kamar->nama_kamar }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Tanggal Lahir</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $santri->tgl_lahir }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Alamat Asal</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $santri->alamat_asal }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection