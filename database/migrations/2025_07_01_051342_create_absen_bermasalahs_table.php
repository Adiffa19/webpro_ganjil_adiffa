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
        Schema::create('absen_bermasalah', function (Blueprint $table) {
            $table->id(); // Kolom "No" otomatis
            $table->string('kode_keterangan')->unique(); // Kolom "Kode Keterangan"
            $table->text('keterangan'); // Kolom "Keterangan"
            $table->string('lokasi'); // Kolom "Lokasi"
            $table->date('tanggal_awal'); // Merepresentasikan "Tanggal Bermasalah"
            $table->date('tanggal_akhir');
            $table->string('shift'); // Kolom "Shift"
            $table->string('kondisi'); // Kolom "Kondisi" (Absen Masuk, Tengah, Pulang)
            $table->string('petugas_input'); // Kolom "Petugas Input"
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_bermasalahs');
    }
};
