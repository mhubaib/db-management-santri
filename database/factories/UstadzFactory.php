<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ustadz>
 */
class UstadzFactory extends Factory
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
            'nip' => $this->faker->unique()->numerify('#####'),
            'spesialisasi' => $this->faker->randomElement(['fiqih', 'tafsir', 'hadist', 'quran', 'kitab', 'bahasa arab'])
        ];
    }
}
