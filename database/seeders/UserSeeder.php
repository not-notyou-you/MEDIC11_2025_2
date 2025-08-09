<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 user default
        User::factory()->defaultAdmin()->create();

        // Membuat 5 user acak (faker)
        User::factory()->count(5)->create();
    }
}
