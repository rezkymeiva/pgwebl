<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('usulan_public', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Usulan
            $table->string('username'); // Nama Pengusul
            $table->string('land_use_change'); // Alih Fungsi Lahan
            $table->text('description')->nullable(); // Deskripsi Usulan

            // Upload dokumen
            $table->string('surat_permohonan')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('sertifikat_tanah')->nullable();
            $table->string('foto_lokasi')->nullable();

            $table->string('contact_person'); // Nomor kontak pengusul

            // Data Spasial
            $table->geometry('geometry'); // Tanpa 4326
            $table->enum('type', ['Point', 'LineString', 'Polygon']); // Tipe Geometri

            // Status Usulan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_public');
    }
};
