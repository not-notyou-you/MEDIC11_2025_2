<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            // Hapus kolom name
            $table->dropColumn('name');
        });
    }

    public function down()
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            // Jika rollback, tambahkan kembali kolom name
            $table->string('name')->after('user_id');
        });
    }
};