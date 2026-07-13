<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek kalau tabel quizzes ada, baru rename
        if (Schema::hasTable('quizzes') && !Schema::hasTable('questions')) {
            Schema::rename('quizzes', 'questions');
        }
    }

    public function down(): void
    {
        // Balik lagi kalau dibutuhkan
        if (Schema::hasTable('questions') && !Schema::hasTable('quizzes')) {
            Schema::rename('questions', 'quizzes');
        }
    }
};
