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
        Schema::create('statistik_lalulintas', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan'); // 1-12
            $table->year('tahun');
            $table->integer('pelanggaran')->default(0);
            $table->integer('kecelakaan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_lalulintas');
    }
};
