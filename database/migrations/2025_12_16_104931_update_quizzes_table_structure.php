<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Pastikan is_published ada dan ada default value
        if (Schema::hasColumn('quizzes', 'is_published')) {
            Schema::table('quizzes', function (Blueprint $table) {
                // Ubah tipe data jika perlu
                $table->boolean('is_published')->default(false)->change();
            });
        } else {
            // Jika kolom tidak ada, tambahkan
            Schema::table('quizzes', function (Blueprint $table) {
                $table->boolean('is_published')->default(false)->after('title');
            });
        }
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('is_published');
        });
    }
};