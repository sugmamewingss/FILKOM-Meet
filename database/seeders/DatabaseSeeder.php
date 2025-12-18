<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Seeding users...');

        // Create Admin
        User::create([
            'name' => 'Admin FILKOM',
            'role' => 'admin',
            'nama_lengkap' => 'Administrator FILKOM',
            'email' => 'admin@filkom.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567890',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Admin created: admin@filkom.ub.ac.id');

        // Create Dosen 1
        User::create([
            'name' => 'Dr. Budi Santoso',
            'role' => 'dosen',
            'nama_lengkap' => 'Dr. Budi Santoso, S.Kom., M.T.',
            'email' => 'dosen@filkom.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567891',
            'nomor_whatsapp' => '081234567891',
            'nip' => '197001011998031001',
            'nidn' => '0001017001',
            'homebase' => 'Teknik Informatika',
            'jabatan_fungsional' => 'Lektor Kepala',
            'bidang_keahlian' => 'Machine Learning, Artificial Intelligence, Data Science',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Dosen 1 created: dosen@filkom.ub.ac.id');

        // Create Dosen 2
        User::create([
            'name' => 'Dr. Sri Wahyuni',
            'role' => 'dosen',
            'nama_lengkap' => 'Dr. Sri Wahyuni, S.T., M.Kom.',
            'email' => 'sri.wahyuni@filkom.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567892',
            'nomor_whatsapp' => '081234567892',
            'nip' => '198505102010122001',
            'nidn' => '0010058501',
            'homebase' => 'Sistem Informasi',
            'jabatan_fungsional' => 'Lektor',
            'bidang_keahlian' => 'Database Systems, Data Mining, Information Systems',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Dosen 2 created: sri.wahyuni@filkom.ub.ac.id');

        // Create Dosen 3
        User::create([
            'name' => 'Prof. Dr. Ahmad Hidayat',
            'role' => 'dosen',
            'nama_lengkap' => 'Prof. Dr. Ahmad Hidayat, S.Kom., M.Sc.',
            'email' => 'ahmad.hidayat@filkom.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567893',
            'nip' => '196505051990031002',
            'nidn' => '0005056501',
            'homebase' => 'Teknik Komputer',
            'jabatan_fungsional' => 'Guru Besar',
            'bidang_keahlian' => 'Computer Networks, IoT, Embedded Systems',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Dosen 3 created: ahmad.hidayat@filkom.ub.ac.id');

        // Create Mahasiswa 1
        User::create([
            'name' => 'Fauzi',
            'role' => 'mahasiswa',
            'nama_lengkap' => 'Ahmad Fauzi',
            'email' => 'mahasiswa@filkom.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567894',
            'nomor_whatsapp' => '081234567894',
            'nim' => '215150200111001',
            'prodi' => 'Teknik Informatika',
            'angkatan' => '2021',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Mahasiswa 1 created: mahasiswa@filkom.ub.ac.id');

        // Create Mahasiswa 2
        User::create([
            'name' => 'Siti',
            'role' => 'mahasiswa',
            'nama_lengkap' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@student.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567895',
            'nomor_whatsapp' => '081234567895',
            'nim' => '215150201111002',
            'prodi' => 'Teknik Informatika',
            'angkatan' => '2021',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Mahasiswa 2 created: siti.nurhaliza@student.ub.ac.id');

        // Create Mahasiswa 3
        User::create([
            'name' => 'Rizki',
            'role' => 'mahasiswa',
            'nama_lengkap' => 'Rizki Ramadhan',
            'email' => 'rizki.ramadhan@student.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567896',
            'nim' => '225150207111003',
            'prodi' => 'Sistem Informasi',
            'angkatan' => '2022',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Mahasiswa 3 created: rizki.ramadhan@student.ub.ac.id');

        // Create Mahasiswa 4
        User::create([
            'name' => 'Dewi',
            'role' => 'mahasiswa',
            'nama_lengkap' => 'Dewi Lestari Putri',
            'email' => 'dewi.lestari@student.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567897',
            'nim' => '225150208111004',
            'prodi' => 'Teknik Komputer',
            'angkatan' => '2022',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Mahasiswa 4 created: dewi.lestari@student.ub.ac.id');

        // Create Mahasiswa 5
        User::create([
            'name' => 'Budi',
            'role' => 'mahasiswa',
            'nama_lengkap' => 'Budi Prasetyo',
            'email' => 'budi.prasetyo@student.ub.ac.id',
            'password' => Hash::make('password'),
            'nomor_hp' => '081234567898',
            'nim' => '235150209111005',
            'prodi' => 'Pendidikan Teknologi Informasi',
            'angkatan' => '2023',
            'fakultas' => 'FILKOM UB',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Mahasiswa 5 created: budi.prasetyo@student.ub.ac.id');

        $this->command->info('');
        $this->command->info('🎉 Seeding completed successfully!');
        $this->command->info('');
        $this->command->info('📧 Login credentials:');
        $this->command->info('   Admin: admin@filkom.ub.ac.id / password');
        $this->command->info('   Dosen: dosen@filkom.ub.ac.id / password');
        $this->command->info('   Mahasiswa: mahasiswa@filkom.ub.ac.id / password');
    }
}