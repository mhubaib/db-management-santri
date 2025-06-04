<?php

namespace Database\Factories;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->date(),
            'santri_id' => $this->faker->randomElement(Santri::pluck('id')),
            'kelas_id' => $this->faker->randomElement(Kelas::pluck('id')),
            'santri_id' => Santri::inRandomOrder()->first()->id?? Santri::factory(),
            'jadwal_id' => Jadwal::inRandomOrder()->first()->id?? Jadwal::factory(),
            'status' => $this->faker->randomElement(['hadir', 'sakit', 'izin', 'alpa', 'terlambat']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
