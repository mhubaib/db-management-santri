<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Ustadz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'pelajaran_id' => Pelajaran::inRandomOrder()->first()->id?? Pelajaran::factory(),
            'ustadz_id' => Ustadz::inRandomOrder()->first()->id?? Ustadz::factory(),
            'jam_mulai' => $this->faker->time('H:i'),
            'jam_selesai' => $this->faker->time('H:i'),
        ];
    }
}
