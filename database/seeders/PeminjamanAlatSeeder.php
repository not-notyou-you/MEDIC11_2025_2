<?php

namespace Database\Seeders;

use App\Models\PeminjamanAlat;
use Illuminate\Database\Seeder;

class PeminjamanAlatSeeder extends Seeder
{
    public function run()
    {
        PeminjamanAlat::factory(8)->create();
    }
}