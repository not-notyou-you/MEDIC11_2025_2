<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ObatLuarFactory extends Factory
{
    public function definition()
    {
        return [
            'nama_obat' => $this->faker->word(),
            'ketentuan' => $this->faker->sentence(),
            'status' => $this->faker->boolean(80)
        ];
    }
}