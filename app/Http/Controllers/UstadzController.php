<?php

namespace App\Http\Controllers;

use App\Models\Ustadz;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class UstadzController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Ustadz::query();

        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);

            $query->whereRaw('LOWER(nama) LIKE ?', ["%$search%"])
                ->orWhereRaw('LOWER(nip::text) LIKE ?', ["%$search%"]); // ← CAST nip jadi teks
        }

        if ($request->has('spesialisasi') && $request->spesialisasi != '') {
            $query->where('spesialisasi', $request->spesialisasi);
        }

        $spesialisasis = Ustadz::distinct()->pluck('spesialisasi')->toArray();

        $ustadzs = $query->latest()->paginate(10);

        return view('ustadz.index', compact('ustadzs', 'spesialisasis'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelajarans = Pelajaran::all();
        return view('ustadz.create', compact('pelajarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:ustadzs',
            'spesialisasi' => 'required|string',
            'pelajaran_ids' => 'nullable|array',
            'pelajaran_ids.*' => 'exists:pelajarans,id',
        ]);

        $ustadz = Ustadz::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'spesialisasi' => $request->spesialisasi,
        ]);

        if ($request->has('pelajaran_ids')) {
            $ustadz->pelajarans()->attach($request->pelajaran_ids);
        }

        return redirect()->route('ustadz.index')
            ->with('success', 'Ustadz berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ustadz $ustadz)
    {
        return view('ustadz.show', compact('ustadz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ustadz $ustadz)
    {
        $pelajarans = Pelajaran::all();
        $selectedPelajarans = $ustadz->pelajarans->pluck('id')->toArray();
        return view('ustadz.edit', compact('ustadz', 'pelajarans', 'selectedPelajarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ustadz $ustadz)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:ustadzs,nip,' . $ustadz->id,
            'spesialisasi' => 'required|string',
            'pelajaran_ids' => 'nullable|array',
            'pelajaran_ids.*' => 'exists:pelajarans,id',
        ]);

        $ustadz->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'spesialisasi' => $request->spesialisasi,
        ]);

        $ustadz->pelajarans()->sync($request->pelajaran_ids ?? []);

        return redirect()->route('ustadz.index')
            ->with('success', 'Data ustadz berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ustadz $ustadz)
    {
        $ustadz->pelajarans()->detach();
        $ustadz->delete();

        return redirect()->route('ustadz.index')
            ->with('success', 'Data ustadz berhasil dihapus!');
    }
}
