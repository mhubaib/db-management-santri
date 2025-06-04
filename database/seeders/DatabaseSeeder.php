<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Santri;
use App\Models\Ustadz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kamar
        Kamar::factory(10)->create();

        // Kelas
        Kelas::factory(10)->create();

        // Pelajaran
        $pelajarans = Pelajaran::factory(10)->create();

        // Ustadz
        Ustadz::factory(10)->create()->each(function ($ustadz) use ($pelajarans) {
            $ustadz->pelajarans()->attach(
                $pelajarans->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Santri
        Santri::factory(20)->create();

        // Jadwal
        Jadwal::factory(10)->create();

        // Absensi
        Absensi::factory(10)->create();
        
    }
}
