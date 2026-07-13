<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ObatMinumFactory extends Factory
{
    public function definition()
    {
        return [
            'nama_obat' => $this->faker->word(),
            'dosis' => $this->faker->randomElement(['1x1', '2x1', '3x1', '1x2']),
            'ketentuan' => $this->faker->sentence(),
            'komposisi' => $this->faker->words(3, true),
            'status' => $this->faker->boolean(80)
        ];
    }
}