<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'nim' => $this->faker->numerify('##########'),
            'jurusan' => $this->faker->randomElement(['Teknik Informatika', 'Kedokteran', 'Ekonomi', 'Hukum']),
            'keluhan' => $this->faker->paragraph(),
            'jenis_penanganan' => $this->faker->randomElement(['medis_dasar', 'p3k']),
            'persetujuan' => true
        ];
    }
}