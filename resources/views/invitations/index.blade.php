<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Undangan Event
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($invitations->isEmpty())
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum Ada Undangan</h3>
                <p class="mt-2 text-gray-600">Anda belum memiliki undangan event</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($invitations as $invitation)
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        <a href="{{ route('events.show', $invitation->event) }}" class="hover:text-blue-600">
                                            {{ $invitation->event->judul_event }}
                                        </a>
                                    </h3>
                                    {!! $invitation->status_badge !!}
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Diundang oleh: <strong class="ml-1">{{ $invitation->event->creator->name }}</strong>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $invitation->event->formatted_date }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $invitation->event->lokasi }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ $invitation->event->jenis_event }}
                                    </div>
                                </div>

                                @if($invitation->event->deskripsi_event)
                                    <p class="mt-3 text-sm text-gray-700">
                                        {{ Str::limit($invitation->event->deskripsi_event, 200) }}
                                    </p>
                                @endif
                            </div>

                            @if($invitation->isPending())
                                <div class="flex flex-col space-y-2 ml-4">
                                    <form action="{{ route('invitations.accept', $invitation) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md font-semibold text-sm text-white bg-green-600 hover:bg-green-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{ route('invitations.decline', $invitation) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        @if($invitation->responded_at)
                            <div class="mt-3 text-xs text-gray-500">
                                Direspon pada: {{ $invitation->responded_at->translatedFormat('d F Y, H:i') }} WIB
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $invitations->links() }}
            </div>
        @endif
    </div>
</x-app-layout>