<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->nullable();
            $table->string('jurusan')->nullable();
            $table->text('keluhan');
            $table->string('jenis_penanganan');
            $table->json('penanganan_obat')->nullable();
            $table->json('kecelakaan')->nullable();
            $table->text('catatan_lanjutan')->nullable();
            $table->boolean('persetujuan')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
};