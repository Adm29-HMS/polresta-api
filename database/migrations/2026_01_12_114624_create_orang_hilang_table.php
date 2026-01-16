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
        Schema::create('orang_hilang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->integer('usia')->nullable();
            $table->date('tanggal_hilang');
            $table->string('lokasi_terakhir');
            $table->text('ciri')->nullable();
            $table->string('kontak');
            $table->string('foto')->nullable();
            $table->enum('status', ['dicari', 'ditemukan'])->default('dicari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_hilang');
    }
};
