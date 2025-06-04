<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->filled('search')) {
            $searchTerm = strtolower($request->search);

            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(nama_kamar) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }
        $kamar = $query->paginate(10)->withQueryString();

        return view('kamar.index', compact('kamar'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            // 'kapasitas' => 'required|integer|min:1'
        ]);

        Kamar::create($request->all());

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil ditambahkan.');
    }

    public function show(Kamar $kamar)
    {
        return view('kamar.show', compact('kamar'));
    }

    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1'
        ]);

        $kamar->update($request->all());

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui.');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil dihapus.');
    }
}