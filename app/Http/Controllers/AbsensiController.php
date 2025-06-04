<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $pelajarans = Jadwal::with('pelajaran')->get()->pluck('pelajaran.nama_pelajaran', 'pelajaran.id')->unique();
        $tanggals = Absensi::distinct()->pluck('tanggal');
        $waktuJadwal = Jadwal::selectRaw("CONCAT(jam_mulai, ' - ', jam_selesai) as waktu")->distinct()->pluck('waktu');
        $kelas = Kelas::pluck('nama_kelas', 'id');
        $tingkatan = Kelas::distinct()->pluck('tingkatan')->toArray(); 

        sort($tingkatan);

        $query = Absensi::with(['santri', 'jadwal.pelajaran', 'kelas'])->latest();

        if ($request->has('filter') && $request->hasAny(['status', 'pelajaran', 'tanggal', 'waktu', 'kelas', 'tingkatan'])) {
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('pelajaran')) {
                $query->whereHas('jadwal', function ($q) use ($request) {
                    $q->where('pelajaran_id', $request->pelajaran);
                });
            }
            if ($request->filled('tanggal')) {
                $query->whereDate('tanggal', $request->tanggal);
            }
            if ($request->filled('waktu')) {
                $waktu = explode(' - ', $request->waktu);
                if (count($waktu) == 2) {
                    $query->whereHas('jadwal', function ($q) use ($waktu) {
                        $q->where('jam_mulai', trim($waktu[0]))
                            ->where('jam_selesai', trim($waktu[1]));
                    });
                }
            }
            
            // Tambahkan filter tingkatan
            if ($request->filled('tingkatan')) {
                $query->whereHas('kelas', function($q) use ($request) {
                    $q->where('tingkatan', $request->tingkatan);
                });
            }

            $absensis = $query->paginate(15)->withQueryString();
        } else {
            $absensis = $query->paginate(15)->withQueryString();
        }

        return view('absensi.index', compact('absensis', 'pelajarans', 'tanggals', 'waktuJadwal', 'kelas', 'tingkatan'));
    }

    public function create(Request $request)
    {
        $pelajarans = Jadwal::with('pelajaran')->get()->pluck('pelajaran.nama_pelajaran', 'pelajaran.id')->unique();
        $tanggals = Jadwal::selectRaw('DISTINCT DATE(created_at) as tanggal')->pluck('tanggal');
        $waktuJadwal = Jadwal::selectRaw("CONCAT(jam_mulai, ' - ', jam_selesai) as waktu")->distinct()->pluck('waktu');
        $kelas = Kelas::pluck('nama_kelas', 'id');
        $tingkatan = Kelas::distinct()->pluck('tingkatan')->toArray();

        sort($tingkatan);
    
        // Tambahkan ini untuk opsi sesi
        $allSesiOptions = Jadwal::select('id', 'nama', 'jam_mulai', 'jam_selesai')
            ->get()
            ->map(function ($jadwal) {
                return [
                    'id' => $jadwal->id,
                    'text' => $jadwal->nama . ' (' . $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai . ')',
                ];
            });
    
        $query = Santri::query();
        $jadwalQuery = Jadwal::query();
    
        // Implementasi filter santri
        if ($request->has('filter')) {
            // Filter berdasarkan kelas
            if ($request->filled('kelas')) {
                $query->where('kelas_id', $request->kelas);
            }
            
            // Filter berdasarkan tingkatan
            if ($request->filled('tingkatan')) {
                $query->whereHas('kelas', function($q) use ($request) {
                    $q->where('tingkatan', $request->tingkatan);
                });
            }
        }
    
        $santris = $query->get();
        $jadwals = $jadwalQuery->with('pelajaran')->orderBy('jam_mulai')->get();
    
        return view('absensi.create', compact(
            'santris',
            'jadwals',
            'pelajarans',
            'tanggals',
            'waktuJadwal',
            'kelas',
            'tingkatan',
            'allSesiOptions'
        ));
    }

    public function store(Request $request)
    {
        // Definisikan pesan validasi kustom
        $messages = [
            'kelas_id.required' => 'Silakan pilih kelas terlebih dahulu melalui filter.', // Ubah pesan validasi
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.', // Ubah pesan validasi
        ];

        // Validasi input dari form dan query string
        $request->validate([
            'selected_santris' => 'required|array',
            'selected_santris.*' => 'exists:santris,id',
            'jadwal_id' => 'required|array',
            'jadwal_id.*' => 'exists:jadwals,id',
            'status' => 'required|array',
            'status.*' => 'in:hadir,sakit,izin,alpa,terlambat',
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id', // Ubah validasi dari 'kelas' menjadi 'kelas_id'
        ], $messages);

        // Ambil kelas_id dari request input (form body)
        $kelasId = $request->input('kelas_id'); // Ubah dari query() menjadi input()

        // Loop melalui santri yang dipilih
        foreach ($request->selected_santris as $santriId) {
            if (isset($request->jadwal_id[$santriId]) && isset($request->status[$santriId])) {
                $jadwalId = $request->jadwal_id[$santriId];
                $jadwal = Jadwal::find($jadwalId);

                if ($jadwal) {
                    Absensi::create([
                        'santri_id' => $santriId,
                        'jadwal_id' => $jadwalId,
                        'status' => $request->status[$santriId],
                        'keterangan' => $request->keterangan[$santriId] ?? null,
                        'tanggal' => $request->tanggal,
                        'kelas_id' => $kelasId,
                    ]);
                }
            }
        }

        return redirect()->route('absensi.index')
            ->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function show(Absensi $absensi)
    {
        $absensi->load(['santri', 'kelas', 'jadwal.pelajaran']);
        return view('absensi.show', compact('absensi'));
    }
}


$jadwals = Jadwal::with('pelajaran')->orderBy('jam_mulai')->get();
