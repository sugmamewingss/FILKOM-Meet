<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Manajemen Event (Admin)
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('admin.events.index') }}" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" placeholder="Cari judul event..." 
                        value="{{ request('search') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <input type="text" name="jenis_event" placeholder="Jenis Event" 
                        value="{{ request('jenis_event') }}"
                        class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'jenis_event']))
                    <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Events Grid -->
        @if($events->isEmpty())
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <p class="text-gray-500">Tidak ada event yang ditemukan</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 flex-1">
                                <a href="{{ route('events.show', $event) }}" class="hover:text-blue-600">
                                    {{ $event->judul_event }}
                                </a>
                            </h3>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Dibuat oleh: <strong class="ml-1">{{ $event->creator->name }}</strong>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $event->short_date }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $event->lokasi }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ $event->jenis_event }}
                            </div>
                        </div>

                        <div class="mt-4 flex space-x-2">
                            {!! $event->status_badge !!}
                            {!! $event->mode_badge !!}
                        </div>

                        <div class="mt-3 text-xs text-gray-500">
                            {{ $event->invitations->count() }} peserta diundang
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</x-app-layout>