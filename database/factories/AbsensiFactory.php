<?php

namespace Database\Factories;

use App\Models\Jadwal;
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
            'santri_id' => Santri::inRandomOrder()->first()->id?? Santri::factory(),
            'jadwal_id' => Jadwal::inRandomOrder()->first()->id?? Jadwal::factory(),
            'status' => $this->faker->randomElement(['hadir', 'sakit', 'izin', 'alpa']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
