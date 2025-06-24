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
        Schema::table('polygon', function (Blueprint $table) {
            // Tambahan tabel baru, urut setelah struktur lama
            $table->string('username')->nullable()->after('image'); // Nama Pengusul
            $table->string('land_use_change')->nullable()->after('username'); // Alih Fungsi Lahan
            $table->text('description_suggestion')->nullable()->after('land_use_change'); // Deskripsi Usulan (dibedakan dari description lama)

            // Upload dokumen
            $table->string('surat_permohonan')->nullable()->after('description_suggestion');
            $table->string('foto_ktp')->nullable()->after('surat_permohonan');
            $table->string('sertifikat_tanah')->nullable()->after('foto_ktp');
            $table->string('foto_lokasi')->nullable()->after('sertifikat_tanah');

            // Kontak Pengusul
            $table->string('contact_person')->nullable()->after('foto_lokasi');

            // Data Spasial Baru
            $table->geometry('geometry')->nullable()->after('contact_person'); // Geometri tanpa SRID
            $table->enum('type', ['Point', 'LineString', 'Polygon'])->nullable()->after('geometry');

            // Status Usulan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polygon', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'land_use_change',
                'description_suggestion',
                'surat_permohonan',
                'foto_ktp',
                'sertifikat_tanah',
                'foto_lokasi',
                'contact_person',
                'geometry',
                'type',
                'status',
            ]);
        });
    }
};
