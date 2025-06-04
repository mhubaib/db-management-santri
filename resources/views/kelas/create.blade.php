@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Kelas Baru</h2>
            </div>

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 mb-4">
                    <div>
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            required>
                        @error('nama_kelas')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tingkatan" class="block text-sm font-medium text-gray-700">Tingkatan</label>
                        <input type="text" name="tingkatan" id="tingkatan" value="{{ old('tingkatan') }}"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            required>
                        @error('tingkatan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('kelas.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection