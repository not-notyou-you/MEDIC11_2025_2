<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->string('type');
            $table->string('phone');
            $table->string('line');
            $table->string('organization');
            $table->string('title');
            $table->string('event_name');
            $table->text('description');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location');
            $table->integer('person')->nullable(); // Diubah menjadi nullable
            $table->json('medical_equipment')->nullable(); // Kolom baru untuk alat kesehatan
            $table->text('note')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};