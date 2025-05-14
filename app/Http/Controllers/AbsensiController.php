<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Santri;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::with(['santri', 'jadwal.pelajaran'])->latest()->get();
        return view('absensi.index', compact('absensis'));
    }

    public function create()
    {
        $santris = Santri::orderBy('nama')->get();
        $jadwals = Jadwal::with('pelajaran')->orderBy('hari')->get();
        return view('absensi.create', compact('santris', 'jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'status' => 'required|in:hadir,sakit,izin,alpa',
            'keterangan' => 'nullable|string',
        ]);
        Absensi::create($request->only(['santri_id', 'jadwal_id', 'status', 'keterangan']));
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $absensi = Absensi::with(['santri', 'jadwal.pelajaran'])->findOrFail($id);
        return view('absensi.show', compact('absensi'));
    }

    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $santris = Santri::orderBy('nama')->get();
        $jadwals = Jadwal::with('pelajaran')->orderBy('hari')->get();
        return view('absensi.edit', compact('absensi', 'santris', 'jadwals'));
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);
        $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'status' => 'required|in:hadir,sakit,izin,alpa',
            'keterangan' => 'nullable|string',
        ]);
        $absensi->update($request->only(['santri_id', 'jadwal_id', 'status', 'keterangan']));
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus!');
    }
}
