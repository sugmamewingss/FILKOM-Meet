<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            @can('create-event')
                <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-orange-600 focus:bg-orange-600 active:bg-orange-700 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Acara Baru
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Greeting -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                Selamat datang!
            </h1>
            <p class="text-gray-600 mt-1">
                {{ now()->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>

        <!-- Admin Stats -->
        @if(Auth::user()->isAdmin() && isset($stats))
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Event</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_events'] }}</p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-full">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Event Mendatang</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['upcoming_events'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Undangan</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_invitations'] }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Today's Events & My Events -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Today's Events -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Acara Hari Ini
                        </h3>
                    </div>
                    <div class="p-6">
                        @forelse($todayEvents as $event)
                            <div class="flex items-start space-x-4 p-4 hover:bg-gray-50 rounded-lg transition mb-3 last:mb-0">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex flex-col items-center justify-center text-white">
                                        <span class="text-xs font-medium">{{ $event->tanggal_mulai->format('H:i') }}</span>
                                        <span class="text-xs">-</span>
                                        <span class="text-xs font-medium">{{ $event->tanggal_selesai->format('H:i') }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600">
                                        {{ $event->judul_event }}
                                    </a>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <span class="inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $event->lokasi }}
                                        </span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $event->jenis_event }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    @if($event->mode_event === 'online')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Online
                                        </span>
                                    @elseif($event->mode_event === 'offline')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Offline
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Hybrid
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Tidak ada acara hari ini</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- My Recent Events -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Event Saya</h3>
                        <a href="{{ route('events.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="p-6">
                        @forelse($myEvents as $event)
                            <div class="border-l-4 {{ $event->isUpcoming() ? 'border-blue-500' : 'border-gray-300' }} pl-4 pb-4 mb-4 last:mb-0 last:pb-0">
                                <a href="{{ route('events.show', $event) }}" class="text-base font-semibold text-gray-900 hover:text-blue-600">
                                    {{ $event->judul_event }}
                                </a>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $event->tanggal_mulai->isoFormat('dddd, D MMMM Y • HH:mm') }} WIB
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $event->jenis_event }} • {{ $event->lokasi }}</p>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-8">Anda belum membuat event apapun</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Pending Invitations -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Undangan
                        </h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                            {{ $pendingInvitations->count() }} pending
                        </span>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($pendingInvitations as $invitation)
                            <div class="p-4 hover:bg-gray-50">
                                <a href="{{ route('events.show', $invitation->event) }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600">
                                    {{ $invitation->event->judul_event }}
                                </a>
                                <p class="text-xs text-gray-600 mt-1">
                                    dari {{ $invitation->event->creator->display_name }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $invitation->event->tanggal_mulai->isoFormat('D MMM Y, HH:mm') }}
                                </p>
                                <div class="flex space-x-2 mt-3">
                                    <form action="{{ route('invitations.accept', $invitation) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700">
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('invitations.decline', $invitation) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Tidak ada undangan baru</p>
                            </div>
                        @endforelse
                    </div>
                    @if($pendingInvitations->count() > 0)
                        <div class="p-4 bg-gray-50 text-center">
                            <a href="{{ route('invitations.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Lihat Semua Undangan →
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Quick Links -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Akses Cepat</h3>
                    <div class="space-y-2">
                        <a href="{{ route('events.calendar') }}" class="block p-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">Lihat Kalender</span>
                            </div>
                        </a>
                        <a href="{{ route('events.index') }}" class="block p-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="font-medium">Kelola Event</span>
                            </div>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block p-3 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="font-medium">Edit Profil</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>