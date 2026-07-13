<?php

namespace Database\Seeders;

use App\Models\ObatLuar;
use Illuminate\Database\Seeder;

class ObatLuarSeeder extends Seeder
{
    public function run()
    {
        ObatLuar::factory(10)->create();
    }
}