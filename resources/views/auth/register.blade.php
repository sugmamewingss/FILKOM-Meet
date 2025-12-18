<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" x-data="{ role: 'mahasiswa' }">
        @csrf

        <!-- Header -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-900">Daftar Akun FILKOM Meet</h2>
            <p class="mt-2 text-sm text-gray-600">Buat akun untuk mulai menggunakan layanan</p>
        </div>

        <!-- Role Selection -->
        <div class="mb-6">
            <x-input-label for="role" :value="__('Daftar Sebagai')" />
            <div class="mt-2 grid grid-cols-2 gap-3">
                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none" :class="role === 'mahasiswa' ? 'border-blue-600 ring-2 ring-blue-600' : 'border-gray-300'">
                    <input type="radio" name="role" value="mahasiswa" class="sr-only" x-model="role" checked>
                    <span class="flex flex-1">
                        <span class="flex flex-col">
                            <span class="block text-sm font-medium text-gray-900">Mahasiswa</span>
                            <span class="mt-1 flex items-center text-sm text-gray-500">Untuk mahasiswa FILKOM UB</span>
                        </span>
                    </span>
                </label>

                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none" :class="role === 'dosen' ? 'border-orange-600 ring-2 ring-orange-600' : 'border-gray-300'">
                    <input type="radio" name="role" value="dosen" class="sr-only" x-model="role">
                    <span class="flex flex-1">
                        <span class="flex flex-col">
                            <span class="block text-sm font-medium text-gray-900">Dosen</span>
                            <span class="mt-1 flex items-center text-sm text-gray-500">Untuk dosen FILKOM UB</span>
                        </span>
                    </span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
            <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required autofocus autocomplete="name_lengkap" />
            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
        </div>

        <!-- Nama Panggilan -->
        <div>
            <x-input-label for="name" :value="__('Nama Panggilan')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- No Hp -->
        <div class="mt-4">
            <x-input-label for="nomor_hp" :value="__('Nomor HP')" />
            <x-text-input id="nomor_hp" class="block mt-1 w-full" type="text" name="nomor_hp" :value="old('nomor_hp')" required autocomplete="nomor_hp" />
            <x-input-error :messages="$errors->get('nomor_hp')" class="mt-2" />
        </div>


        <!-- Mahasiswa Fields -->
        <div x-show="role === 'mahasiswa'" class="space-y-4 mt-4">
            <!-- NIM -->
            <div>
                <x-input-label for="nim" :value="__('NIM')" />
                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" />
                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>

            <!-- Prodi -->
            <div>
                <x-input-label for="prodi" :value="__('Program Studi')" />
                <select id="prodi" name="prodi" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                    <option value="">Pilih Program Studi</option>
                    <option value="Teknik Informatika" {{ old('prodi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                    <option value="Sistem Informasi" {{ old('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                    <option value="Teknik Komputer" {{ old('prodi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                    <option value="Pendidikan Teknologi Informasi" {{ old('prodi') == 'Pendidikan Teknologi Informasi' ? 'selected' : '' }}>Pendidikan Teknologi Informasi</option>
                    <option value="Teknologi Informasi" {{ old('prodi') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                </select>
                <x-input-error :messages="$errors->get('prodi')" class="mt-2" />
            </div>

            <!-- Angkatan -->
            <div>
                <x-input-label for="angkatan" :value="__('Angkatan')" />
                <x-text-input id="angkatan" class="block mt-1 w-full" type="text" name="angkatan" :value="old('angkatan')" placeholder="2024" />
                <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
            </div>
        </div>

        <!-- Dosen Fields -->
        <div x-show="role === 'dosen'" class="space-y-4 mt-4">
            <!-- NIP -->
            <div>
                <x-input-label for="nip" :value="__('NIP')" />
                <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" />
                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
            </div>

            <!-- NIDN (Optional) -->
            <div>
                <x-input-label for="nidn" :value="__('NIDN (Opsional)')" />
                <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn')" />
                <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
            </div>

            <!-- Homebase -->
            <div>
                <x-input-label for="homebase" :value="__('Homebase / Program Studi')" />
                <select id="homebase" name="homebase" class="block mt-1 w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm">
                    <option value="">Pilih Homebase</option>
                    <option value="Teknik Informatika" {{ old('homebase') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                    <option value="Sistem Informasi" {{ old('homebase') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                    <option value="Teknik Komputer" {{ old('homebase') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                    <option value="Pendidikan Teknologi Informasi" {{ old('homebase') == 'Pendidikan Teknologi Informasi' ? 'selected' : '' }}>Pendidikan Teknologi Informasi</option>
                    <option value="Teknologi Informasi" {{ old('homebase') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                </select>
                <x-input-error :messages="$errors->get('homebase')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>