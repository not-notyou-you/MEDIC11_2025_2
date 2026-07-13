<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder2 extends Seeder
{
    public function run()
    {
        $this->call([
            ObatLuarSeeder::class,
            ObatMinumSeeder::class,
            PasienSeeder::class,
            PeminjamanAlatSeeder::class,
        ]);
    }
}