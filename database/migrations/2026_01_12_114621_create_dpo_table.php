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
        Schema::create('dpo', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('nama');
            $table->string('alias')->nullable();
            $table->string('kasus');
            $table->text('ciri_fisik')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'tertangkap', 'menyerahkan_diri', 'meninggal'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpo');
    }
};
