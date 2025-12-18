<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Basic info
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->default('mahasiswa')->after('id');
            $table->string('nama_lengkap')->nullable()->after('name');
            $table->string('name')->nullable()->after('nama_lengkap');
            $table->string('nomor_hp')->nullable()->after('email');
            $table->string('nomor_whatsapp')->nullable()->after('nomor_hp');
            $table->string('foto_profil')->nullable()->after('nomor_whatsapp');
            
            // Mahasiswa fields
            $table->string('nim')->nullable()->unique()->after('foto_profil');
            $table->string('prodi')->nullable()->after('nim');
            $table->string('fakultas')->default('FILKOM UB')->after('prodi');
            $table->string('angkatan')->nullable()->after('fakultas');
            
            // Dosen fields
            $table->string('nip')->nullable()->unique()->after('angkatan');
            $table->string('nidn')->nullable()->unique()->after('nip');
            $table->string('homebase')->nullable()->after('nidn');
            $table->string('jabatan_fungsional')->nullable()->after('homebase');
            $table->text('bidang_keahlian')->nullable()->after('jabatan_fungsional');
            
            // Soft deletes
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'nama_lengkap', 'name', 'nomor_hp', 
                'nomor_whatsapp', 'foto_profil', 'nim', 'prodi', 'fakultas', 
                'angkatan', 'nip', 'nidn', 'homebase', 'jabatan_fungsional', 
                'bidang_keahlian'
            ]);
            $table->dropSoftDeletes();
        });
    }
};
