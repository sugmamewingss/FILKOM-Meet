<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Event::with('creator');
        
        if ($request->filled('jenis_event')) {
            $query->where('jenis_event', $request->jenis_event);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('judul_event', 'like', "%{$search}%");
        }
        
        $events = $query->orderBy('tanggal_mulai', 'desc')->paginate(20);
        
        return view('admin.events.index', compact('events'));
    }

    public function destroy(Event $event)
    {
        $event->delete();
        
        return back()->with('success', 'Event berhasil dihapus!');
    }
}