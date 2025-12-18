<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->after('id');
            $table->string('nama_lengkap')->after('role');
            $table->string('nama_panggilan')->nullable()->after('nama_lengkap');
            $table->string('nomor_hp')->nullable()->after('email');
            $table->string('nomor_whatsapp')->nullable()->after('nomor_hp');
            $table->string('foto_profil')->nullable()->after('nomor_whatsapp');
            
            // Mahasiswa fields
            $table->string('nim')->nullable()->after('foto_profil');
            $table->string('prodi')->nullable()->after('nim');
            $table->string('fakultas')->default('FILKOM UB')->after('prodi');
            $table->string('angkatan')->nullable()->after('fakultas');
            
            // Dosen fields
            $table->string('nip')->nullable()->after('angkatan');
            $table->string('nidn')->nullable()->after('nip');
            $table->string('homebase')->nullable()->after('nidn');
            $table->string('jabatan_fungsional')->nullable()->after('homebase');
            $table->text('bidang_keahlian')->nullable()->after('jabatan_fungsional');
            
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'nama_lengkap', 'nama_panggilan', 'nomor_hp', 
                'nomor_whatsapp', 'foto_profil', 'nim', 'prodi', 'fakultas', 
                'angkatan', 'nip', 'nidn', 'homebase', 'jabatan_fungsional', 
                'bidang_keahlian'
            ]);
            $table->dropSoftDeletes();
        });
    }
};