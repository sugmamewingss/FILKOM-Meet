<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Detail Event
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                @if($event->isOwner(auth()->user()) || auth()->user()->isAdmin())
                    <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Event Info Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700">
                        <h1 class="text-2xl font-bold text-white mb-2">{{ $event->judul_event }}</h1>
                        <div class="flex items-center space-x-4 text-blue-100">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>{{ $event->creator->name }}</span>
                            </div>
                            <div class="flex space-x-2">
                                {!! $event->status_badge !!}
                                {!! $event->mode_badge !!}
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Jenis Event -->
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Jenis Event</p>
                                    <p class="text-base font-medium text-gray-900">{{ $event->jenis_event }}</p>
                                </div>
                            </div>

                            <!-- Tanggal & Waktu -->
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal & Waktu</p>
                                    <p class="text-base font-medium text-gray-900">{{ $event->formatted_date }}</p>
                                    <p class="text-sm text-gray-600 mt-1">Durasi: {{ $event->duration_in_minutes }} menit</p>
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Lokasi</p>
                                    <p class="text-base font-medium text-gray-900">{{ $event->lokasi }}</p>
                                    <p class="text-sm text-gray-600 mt-1">Mode: {{ ucfirst($event->mode_event) }}</p>
                                </div>
                            </div>

                            <!-- Meeting Link (jika ada) -->
                            @if($event->meeting_link)
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Link Meeting</p>
                                        <a href="{{ $event->meeting_link }}" target="_blank" class="text-base font-medium text-blue-600 hover:text-blue-800">
                                            {{ $event->meeting_link }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- SKS (jika ada) -->
                            @if($event->sks)
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">SKS</p>
                                        <p class="text-base font-medium text-gray-900">{{ $event->sks }} SKS</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Deskripsi -->
                        @if($event->deskripsi_event)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                                <p class="text-gray-700 whitespace-pre-line">{{ $event->deskripsi_event }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Participants Card -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Peserta yang Diundang</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $event->invitations->count() }} orang</p>
                    </div>

                    <div class="p-6">
                        @if($event->invitations->isEmpty())
                            <p class="text-sm text-gray-500 text-center py-4">Belum ada peserta yang diundang</p>
                        @else
                            <div class="space-y-3">
                                @foreach($event->invitations as $invitation)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="{{ $invitation->user->foto_profil_url }}" alt="{{ $invitation->user->name }}" class="w-10 h-10 rounded-full">
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $invitation->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $invitation->user->role_name }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            {!! $invitation->status_badge !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Status Summary -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Status</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Diterima</span>
                            <span class="text-sm font-semibold text-green-600">
                                {{ $event->invitations->where('status', 'accepted')->count() }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Menunggu</span>
                            <span class="text-sm font-semibold text-yellow-600">
                                {{ $event->invitations->where('status', 'pending')->count() }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Ditolak</span>
                            <span class="text-sm font-semibold text-red-600">
                                {{ $event->invitations->where('status', 'declined')->count() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                    <div class="space-y-2">
                        <a href="{{ route('events.calendar') }}" class="block p-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">Lihat di Kalender</span>
                            </div>
                        </a>
                        <a href="{{ route('events.index') }}" class="block p-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="font-medium">Semua Event</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>