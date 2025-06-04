<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pelajaran;
use App\Models\Ustadz;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jadwal::query()->with(['pelajaran', 'ustadz']);

        // apply search filter if search parameters exist
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
                $query->whereHas('pelajaran', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_pelajaran) LIKE ?', ['%' . $search . '%']);
                })
                ->orWhereHas('ustadz', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama) LIKE ?', ['%' . $search . '%']);
                });
        }

                // Apply pelajaran filter
                if ($request->has('pelajaran') && $request->pelajaran != '') {
                $query->where('pelajaran_id', $request->pelajaran);
                }
    
    $jadwals = $query->paginate(10);
    
    // Load the pelajaran data for the filter dropdowns
    $pelajaran = \App\Models\Pelajaran::all(); // Replace with your actual Pelajaran model
    
    return view('jadwal.index', compact('jadwals', 'pelajaran'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelajaran = Pelajaran::all();
        $ustadz = Ustadz::all();
        // Hapus array hari karena tidak digunakan lagi
        
        return view('jadwal.create', compact('pelajaran', 'ustadz'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'ustadz_id' => 'required|exists:ustadzs,id',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
        ]);
    
        // Only include the validated fields
        Jadwal::create($request->only([
            'nama',
            'pelajaran_id',
            'ustadz_id',
            'jam_mulai',
            'jam_selesai',
        ]));
        
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $pelajaran = Pelajaran::all();
        $ustadz = Ustadz::all();

        return view('jadwal.edit', compact('jadwal', 'pelajaran', 'ustadz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'nama' =>'required|string|max:255',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'ustadz_id' => 'required|exists:ustadzs,id',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
        ]);

        // Hanya gunakan field yang divalidasi
        $jadwal->update($request->only([
            'nama',
            'pelajaran_id',
            'ustadz_id',
            'jam_mulai',
            'jam_selesai',
        ]));
        
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
