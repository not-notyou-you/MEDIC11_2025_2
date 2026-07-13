<?php

namespace Database\Seeders;

use App\Models\ObatMinum;
use Illuminate\Database\Seeder;

class ObatMinumSeeder extends Seeder
{
    public function run()
    {
        ObatMinum::factory(10)->create();
    }
}