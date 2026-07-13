<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('email_queue', function (Blueprint $table) {
            // Tambahkan kolom email_subject
            $table->string('email_subject')->nullable()->after('email_content');
        });
    }

    public function down(): void
    {
        Schema::table('email_queue', function (Blueprint $table) {
            $table->dropColumn('email_subject');
        });
    }
};