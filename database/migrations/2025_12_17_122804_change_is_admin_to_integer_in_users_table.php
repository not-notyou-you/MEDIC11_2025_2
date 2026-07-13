<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah tipe kolom dari boolean ke integer
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_admin')->default(0)->change();
        });

        // Update data yang ada (opsional, tapi baik dilakukan)
        DB::table('users')->where('is_admin', 1)->update(['is_admin' => 1]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->change();
        });
        
        // Konversi kembali saat rollback
        DB::table('users')->where('is_admin', '>=', 1)->update(['is_admin' => 1]);
    }
};