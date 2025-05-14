<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelajarans = Pelajaran::latest()->get();
        return view('pelajaran.index', compact('pelajarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pelajaran' => 'required|string|max:50|unique:pelajarans,kode_pelajaran',
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        Pelajaran::create([
            'kode_pelajaran' => $request->kode_pelajaran,
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return redirect()->route('pelajaran.index')
            ->with('success', 'Pelajaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        return view('pelajaran.show', compact('pelajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        return view('pelajaran.edit', compact('pelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $request->validate([
            'kode_pelajaran' => 'required|string|max:50|unique:pelajarans,kode_pelajaran,' . $pelajaran->id,
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        $pelajaran->update([
            'kode_pelajaran' => $request->kode_pelajaran,
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return redirect()->route('pelajaran.index')
            ->with('success', 'Data pelajaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->delete();
        return redirect()->route('pelajaran.index')
            ->with('success', 'Data pelajaran berhasil dihapus!');
    }
}
