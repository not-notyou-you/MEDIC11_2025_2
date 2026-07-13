<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanAlatFactory extends Factory
{
    public function definition()
    {
        return [
            'email_nomor_hp' => $this->faker->email(),
            'nama_peminjam' => $this->faker->name(),
            'nim_peminjam' => $this->faker->numerify('##########'),
            'barang_dipinjam' => $this->faker->randomElement(['Termometer', 'Tensimeter', 'Stetoskop', 'Kursi Roda']),
            'lama_peminjaman' => $this->faker->numberBetween(1, 7),
            'status' => $this->faker->boolean(50),
            'catatan_tambahan' => $this->faker->sentence()
        ];
    }
}