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
        Schema::create('kriminal', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan')->unique();
            $table->date('tanggal');
            $table->enum('jenis', ['pencurian', 'narkoba', 'kekerasan', 'penipuan', 'lainnya'])->default('lainnya');
            $table->enum('status', ['penyelidikan', 'penyidikan', 'selesai'])->default('penyelidikan');
            $table->string('lokasi');
            $table->text('kronologi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriminal');
    }
};
