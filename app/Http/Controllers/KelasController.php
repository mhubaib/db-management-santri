<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kelas::query();
        
        if ($request->filled('search')) {
            $searchTerm = strtolower($request->search);
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(nama_kelas) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(CAST(tingkatan AS TEXT)) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }
        
        if ($request->filled('tingkatan')) {
            $query->where('tingkatan', $request->tingkatan);
        }
        
        $kelas = $query->latest()->paginate(15)->withQueryString();
        
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:50' // Mengubah tingkat menjadi tingkatan sesuai nama kolom di database
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkatan' => $request->tingkatan
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:50' // Mengubah tingkat menjadi tingkatan sesuai nama kolom di database
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkatan' => $request->tingkatan
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}