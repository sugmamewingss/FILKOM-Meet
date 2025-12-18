<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FILKOM Meet - Sistem Manajemen Acara Akademik</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-900">FILKOM Meet</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 transition">
                                Daftar Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        Kelola Acara Akademik<br>Lebih Mudah dan Efisien
                    </h1>
                    <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                        Platform manajemen acara khusus untuk Fakultas Ilmu Komputer Universitas Brawijaya. 
                        Atur jadwal kuliah tamu, rapat, bimbingan, dan kegiatan lainnya dalam satu sistem.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-orange-500 text-white rounded-lg font-semibold text-lg hover:bg-orange-600 transition shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-50 transition shadow-lg">
                            Login ke Akun
                        </a>
                    </div>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-500 rounded-full opacity-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-orange-500 rounded-full opacity-20 blur-3xl"></div>
        </div>

        <!-- Features Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk mengelola acara akademik dengan lebih baik
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kalender Interaktif</h3>
                    <p class="text-gray-600">
                        Lihat semua acara Anda dalam kalender visual yang mudah dipahami. Filter berdasarkan jenis acara dan status.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Notifikasi Otomatis</h3>
                    <p class="text-gray-600">
                        Dapatkan notifikasi email untuk undangan baru, perubahan acara, dan pengingat acara yang akan datang.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Manajemen Peserta</h3>
                    <p class="text-gray-600">
                        Undang dosen dan mahasiswa dengan mudah. Pantau status kehadiran dan kelola daftar peserta acara.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600">
                        Sistem role-based access control memastikan hanya pengguna yang berwenang yang dapat mengakses fitur tertentu.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laporan Lengkap</h3>
                    <p class="text-gray-600">
                        Akses laporan dan statistik acara untuk evaluasi dan perencanaan kegiatan akademik yang lebih baik.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Responsive Design</h3>
                    <p class="text-gray-600">
                        Akses dari perangkat apapun - desktop, tablet, atau smartphone dengan tampilan yang optimal.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Siap Memulai?
                </h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan dosen dan mahasiswa FILKOM UB lainnya dalam mengelola acara akademik dengan lebih efisien.
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-orange-500 text-white rounded-lg font-semibold text-lg hover:bg-orange-600 transition shadow-lg">
                    Daftar Gratis Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <svg class="h-8 w-8 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            <span class="ml-2 text-xl font-bold">FILKOM Meet</span>
                        </div>
                        <p class="text-gray-400">
                            Sistem manajemen acara akademik untuk Fakultas Ilmu Komputer Universitas Brawijaya.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>Fakultas Ilmu Komputer UB</li>
                            <li>Jl. Veteran, Malang</li>
                            <li>Email: info@filkom.ub.ac.id</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition">Daftar</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} FILKOM Meet. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>