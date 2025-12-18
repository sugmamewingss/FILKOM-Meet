<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Edit Event
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700">
                <h3 class="text-xl font-bold text-white">Edit Informasi Event</h3>
                <p class="text-blue-100 mt-1">Perbarui detail event</p>
            </div>

            <form action="{{ route('events.update', $event) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul Event -->
                <div>
                    <label for="judul_event" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Event <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul_event" id="judul_event" required
                        value="{{ old('judul_event', $event->judul_event) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('judul_event')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Event & Visibility -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis_event" class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Event <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_event" id="jenis_event" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Jenis Event</option>
                            @foreach($jenisEventOptions as $option)
                                <option value="{{ $option }}" {{ old('jenis_event', $event->jenis_event) == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="visibility" class="block text-sm font-medium text-gray-700 mb-2">Visibilitas <span class="text-red-500">*</span></label>
                        <select name="visibility" id="visibility" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="invited_only" {{ old('visibility', $event->visibility) == 'invited_only' ? 'selected' : '' }}>Hanya yang Diundang</option>
                            <option value="public" {{ old('visibility', $event->visibility) == 'public' ? 'selected' : '' }}>Publik</option>
                            <option value="private" {{ old('visibility', $event->visibility) == 'private' ? 'selected' : '' }}>Privat</option>
                        </select>
                    </div>
                </div>

                <!-- Tanggal & Waktu -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu Mulai <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" required
                            value="{{ old('tanggal_mulai', $event->tanggal_mulai->format('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu Selesai <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" required
                            value="{{ old('tanggal_selesai', $event->tanggal_selesai->format('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Mode & Lokasi -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="mode_event" class="block text-sm font-medium text-gray-700 mb-2">Mode <span class="text-red-500">*</span></label>
                        <select name="mode_event" id="mode_event" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="offline" {{ old('mode_event', $event->mode_event) == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="online" {{ old('mode_event', $event->mode_event) == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="hybrid" {{ old('mode_event', $event->mode_event) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" id="lokasi" required value="{{ old('lokasi', $event->lokasi) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Meeting Link & SKS -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="meeting_link" class="block text-sm font-medium text-gray-700 mb-2">Link Meeting (opsional)</label>
                        <input type="url" name="meeting_link" id="meeting_link" value="{{ old('meeting_link', $event->meeting_link) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="sks" class="block text-sm font-medium text-gray-700 mb-2">SKS (opsional)</label>
                        <input type="number" name="sks" id="sks" step="0.5" min="0" max="10" value="{{ old('sks', $event->sks) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi_event" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Event</label>
                    <textarea name="deskripsi_event" id="deskripsi_event" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('deskripsi_event', $event->deskripsi_event) }}</textarea>
                </div>

                <!-- Participants -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Undang Peserta</label>
                    <div class="border border-gray-300 rounded-lg p-4 max-h-64 overflow-y-auto">
                        @foreach($users->groupBy('role') as $role => $roleUsers)
                            <div class="mb-4 last:mb-0">
                                <h4 class="font-semibold text-gray-700 mb-2 uppercase text-xs">{{ ucfirst($role) }}</h4>
                                <div class="space-y-2">
                                    @foreach($roleUsers as $user)
                                        <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                                            <input type="checkbox" name="participants[]" value="{{ $user->id }}"
                                                {{ in_array($user->id, old('participants', $selectedParticipants)) ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
                                                <span class="text-xs text-gray-500 block">{{ $user->email }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                    <a href="{{ route('events.show', $event) }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 font-medium shadow-lg">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>