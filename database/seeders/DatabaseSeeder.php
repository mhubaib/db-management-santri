<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Santri;
use App\Models\Kamar;
use App\Models\Kelas;
use App\Models\Ustadz;
use App\Models\Pelajaran;
use App\Models\Jadwal;
use App\Models\Absensi;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kamar
        Kamar::factory(10)->create();

        // Kelas
        Kelas::factory(8)->create();

        // Pelajaran
        $pelajarans = Pelajaran::factory(10)->create();

        // Ustadz
        Ustadz::factory(15)->create()->each(function ($ustadz) use ($pelajarans) {
            $ustadz->pelajarans()->attach(
                $pelajarans->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Santri
        Santri::factory(50)->create();

        // Jadwal
        Jadwal::factory(20)->create();

        // Absensi
        Absensi::factory(1000)->create();
    }
}
