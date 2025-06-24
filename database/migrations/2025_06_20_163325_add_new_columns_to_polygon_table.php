<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('polygon', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('land_use_change')->nullable();
            $table->text('description_suggestion')->nullable();

            $table->string('surat_permohonan')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('sertifikat_tanah')->nullable();
            $table->string('foto_lokasi')->nullable();

            $table->string('contact_person')->nullable();
            $table->enum('type', ['Point', 'LineString', 'Polygon'])->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        });
    }

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
                'type',
                'status'
            ]);
        });
    }
};
