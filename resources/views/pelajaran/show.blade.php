@extends('layouts.app')

@section('title', 'Detail Pelajaran')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Detail Pelajaran</h2>
            </div>
            <div class="mb-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody>
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Kode Pelajaran</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Nama Pelajaran</th>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $pelajaran->kode_pelajaran }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $pelajaran->nama_pelajaran }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('pelajaran.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali
                </a>
                <a href="{{ route('pelajaran.edit', $pelajaran->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
