<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Invitation;
use App\Notifications\EventInvitation;
use App\Notifications\EventUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Event::with('creator');
        
        if (!$user->isAdmin()) {
            $query->where(function ($q) use ($user) {
                $q->where('created_by', $user->id)
                  ->orWhereHas('participants', function ($subQ) use ($user) {
                      $subQ->where('user_id', $user->id);
                  });
            });
        }
        
        $events = $query->orderBy('tanggal_mulai', 'desc')->paginate(12);
        
        return view('events.index', compact('events'));
    }

    public function create()
    {
        Gate::authorize('create', Event::class);
        
        $users = User::where('id', '!=', auth()->id())
            ->select('id', 'name', 'role', 'email')
            ->orderBy('role')
            ->orderBy('name')
            ->get();
        
        $jenisEventOptions = [
            'Kuliah Tamu', 'Rapat', 'Bimbingan', 'Janji Temu', 
            'Konsultasi', 'Seminar', 'Workshop', 'Kegiatan Organisasi', 'Lainnya'
        ];
        
        return view('events.create', compact('users', 'jenisEventOptions'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Event::class);
        
        $validated = $request->validate([
            'judul_event' => 'required|string|max:255',
            'deskripsi_event' => 'nullable|string',
            'jenis_event' => 'required|string',
            'tanggal_mulai' => 'required|date|after_or_equal:now',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'mode_event' => 'required|in:offline,online,hybrid',
            'meeting_link' => 'nullable|url',
            'sks' => 'nullable|numeric|min:0|max:10',
            'visibility' => 'required|in:private,invited_only,public',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id',
        ]);
        
        $validated['created_by'] = auth()->id();
        
        $start = \Carbon\Carbon::parse($validated['tanggal_mulai']);
        $end = \Carbon\Carbon::parse($validated['tanggal_selesai']);
        $validated['durasi'] = $start->diffInMinutes($end);
        
        $event = Event::create($validated);
        
        if ($request->has('participants')) {
            foreach ($request->participants as $userId) {
                $invitation = Invitation::create([
                    'event_id' => $event->id,
                    'user_id' => $userId,
                    'status' => 'pending',
                    'invited_at' => now(),
                ]);
                
                $user = User::find($userId);
                $user->notify(new EventInvitation($event, $invitation));
            }
        }
        
        return redirect()->route('events.show', $event)
            ->with('success', 'Event berhasil dibuat dan undangan telah dikirim!');
    }

    public function show(Event $event)
    {
        Gate::authorize('view', $event);
        $event->load(['creator', 'invitations.user']);
        
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        Gate::authorize('update', $event);
        
        $users = User::where('id', '!=', auth()->id())
            ->select('id', 'name', 'role', 'email')
            ->orderBy('role')->orderBy('name')->get();
        
        $jenisEventOptions = [
            'Kuliah Tamu', 'Rapat', 'Bimbingan', 'Janji Temu', 
            'Konsultasi', 'Seminar', 'Workshop', 'Kegiatan Organisasi', 'Lainnya'
        ];
        
        $selectedParticipants = $event->invitations->pluck('user_id')->toArray();
        
        return view('events.edit', compact('event', 'users', 'jenisEventOptions', 'selectedParticipants'));
    }

    public function update(Request $request, Event $event)
    {
        Gate::authorize('update', $event);
        
        $validated = $request->validate([
            'judul_event' => 'required|string|max:255',
            'deskripsi_event' => 'nullable|string',
            'jenis_event' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'mode_event' => 'required|in:offline,online,hybrid',
            'meeting_link' => 'nullable|url',
            'sks' => 'nullable|numeric|min:0|max:10',
            'visibility' => 'required|in:private,invited_only,public',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id',
        ]);
        
        $start = \Carbon\Carbon::parse($validated['tanggal_mulai']);
        $end = \Carbon\Carbon::parse($validated['tanggal_selesai']);
        $validated['durasi'] = $start->diffInMinutes($end);
        
        $event->update($validated);
        
        if ($request->has('participants')) {
            $currentParticipants = $event->invitations->pluck('user_id')->toArray();
            $newParticipants = $request->participants;
            
            $toRemove = array_diff($currentParticipants, $newParticipants);
            Invitation::where('event_id', $event->id)
                ->whereIn('user_id', $toRemove)->delete();
            
            $toAdd = array_diff($newParticipants, $currentParticipants);
            foreach ($toAdd as $userId) {
                $invitation = Invitation::create([
                    'event_id' => $event->id,
                    'user_id' => $userId,
                    'status' => 'pending',
                    'invited_at' => now(),
                ]);
                
                $user = User::find($userId);
                $user->notify(new EventInvitation($event, $invitation));
            }
            
            foreach ($event->acceptedParticipants as $participant) {
                $participant->notify(new EventUpdated($event));
            }
        }
        
        return redirect()->route('events.show', $event)
            ->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);
        
        $event->delete();
        
        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus!');
    }
    
    public function calendar()
    {
        return view('events.calendar');
    }
    
    public function calendarData(Request $request)
    {
        $user = $request->user();
        $query = Event::query();
        
        if (!$user->isAdmin()) {
            $query->where(function ($q) use ($user) {
                $q->where('created_by', $user->id)
                  ->orWhereHas('participants', function ($subQ) use ($user) {
                      $subQ->where('user_id', $user->id)
                           ->where('status', 'accepted');
                  });
            });
        }
        
        $events = $query->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->judul_event,
                'start' => $event->tanggal_mulai->toIso8601String(),
                'end' => $event->tanggal_selesai->toIso8601String(),
                'url' => route('events.show', $event),
                'backgroundColor' => $event->isOwner(auth()->user()) ? '#3B82F6' : '#F97316',
            ];
        });
        
        return response()->json($events);
    }
}