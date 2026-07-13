<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peminjaman_alats', function (Blueprint $table) {
            $table->id();
            $table->string('email_nomor_hp');
            $table->string('nama_peminjam');
            $table->string('nim_peminjam');
            $table->string('barang_dipinjam');
            $table->integer('lama_peminjaman');
            $table->boolean('status')->default(false);
            $table->text('catatan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman_alats');
    }
};