<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Kamar;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santris = Santri::with(['kelas', 'kamar'])->latest()->get();
        return view('santri.index', compact('santris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        $kamar = Kamar::all();
        return view('santri.create', compact('kelas', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'kamar_id' => 'required|exists:kamars,id',
            'nama' => 'required|string|max:255',
            'nis' => 'required|integer|unique:santris',
            'tgl_lahir' => 'required|string',
            'alamat_asal' => 'required|string',
        ]);

        Santri::create($request->all());

        return redirect()->route('santri.index')
            ->with('success', 'Santri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        return view('santri.show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        $kelas = Kelas::all();
        $kamar = Kamar::all();
        return view('santri.edit', compact('santri', 'kelas', 'kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'kamar_id' => 'required|exists:kamars,id',
            'nama' => 'required|string|max:255',
            'nis' => 'required|integer|unique:santris,nis,' . $santri->id,
            'tgl_lahir' => 'required|string',
            'alamat_asal' => 'required|string',
        ]);

        $santri->update($request->all());

        return redirect()->route('santri.index')
            ->with('success', 'Data santri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        $santri->delete();

        return redirect()->route('santri.index')
            ->with('success', 'Data santri berhasil dihapus!');
    }
}