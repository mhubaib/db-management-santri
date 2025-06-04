@extends('layouts.app')

@section('title', 'Daftar Pelajaran')

@section('content')
    <div class="bg-white overflow-hidden shadow-xl rounded-lg border border-gray-100">
        <div class="px-8 py-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-primary-800">Daftar Pelajaran</h2>
                <a href="{{ route('pelajaran.create') }}"
                    class="px-5 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-300 flex items-center gap-2 font-medium shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Pelajaran
                </a>
            </div>

            {{-- Search Form --}}
            <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                <form action="{{ route('pelajaran.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow flex">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="bg-white border border-gray-200 text-gray-900 text-sm rounded-l-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5"
                            placeholder="Cari pelajaran...">
                        <button type="submit"
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition-all duration-300 flex items-center gap-2 font-medium shadow-sm">
                            Cari
                        </button>
                    </div>
                    @if (request()->filled('search'))
                        <a href="{{ route('pelajaran.index') }}"
                            class="px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 flex items-center gap-2 font-medium shadow-sm">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead>
                        <tr class="bg-gray-50">
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                                No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kode</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Pelajaran</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pelajarans as $index => $pelajaran)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ ($pelajarans->currentPage() - 1) * $pelajarans->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $pelajaran->kode_pelajaran }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-700">
                                    {{ $pelajaran->nama_pelajaran }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('pelajaran.show', $pelajaran->id) }}"
                                            class="p-1.5 text-blue-600 hover:bg-blue-50 rounded" title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('pelajaran.edit', $pelajaran->id) }}"
                                            class="p-1.5 text-yellow-600 hover:bg-yellow-50 rounded" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828L13 9.828l-2.828-2.828 3.414-3.414z" />
                                                <path d="M12.121 10.121L4 18.243V20h1.757l8.122-8.121-1.758-1.758z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('pelajaran.destroy', $pelajaran->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9z"
                                                        clip-rule="evenodd" />
                                                    <path
                                                        d="M7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zM11 8a1 1 0 012 0v6a1 1 0 11-2 0V8z" />
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
                                        <p class="font-medium">Tidak ada data pelajaran</p>
                                        <p class="text-gray-400 mt-1">Silahkan tambahkan data pelajaran terlebih dahulu</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($pelajarans->hasPages())
                <div class="px-6 py-4 bg-white border-t border-gray-200">
                    {{ $pelajarans->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
