<?php

namespace Database\Factories;

use App\Models\Kamar;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
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
            'nis' => $this->faker->unique()->numerify('#######'),
            'tgl_lahir' => $this->faker->date(),
            'alamat_asal' => $this->faker->address(),
            'kelas_id' => Kelas::inRandomOrder()->first()->id ?? Kelas::factory(),
            'kamar_id' => Kamar::inRandomOrder()->first()->id ?? Kamar::factory(),
        ];
    }
}
