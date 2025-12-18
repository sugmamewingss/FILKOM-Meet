<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Event yang dibuat user
        $myEvents = Event::where('created_by', $user->id)
            ->orderBy('tanggal_mulai', 'desc')
            ->take(5)
            ->get();
        
        // Event hari ini
        $todayEvents = Event::where(function ($query) use ($user) {
                $query->where('created_by', $user->id)
                    ->orWhereHas('participants', function ($q) use ($user) {
                        $q->where('user_id', $user->id)
                          ->where('status', 'accepted');
                    });
            })
            ->whereDate('tanggal_mulai', Carbon::today())
            ->orderBy('tanggal_mulai')
            ->get();
        
        // Undangan pending
        $pendingInvitations = Invitation::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with(['event.creator'])
            ->latest()
            ->take(5)
            ->get();
        
        // Statistik untuk admin
        $stats = null;
        if ($user->isAdmin()) {
            $stats = [
                'total_users' => User::count(),
                'total_dosen' => User::where('role', 'dosen')->count(),
                'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
                'total_events' => Event::count(),
                'upcoming_events' => Event::where('tanggal_mulai', '>', now())->count(),
                'total_invitations' => Invitation::count(),
            ];
        }
        
        return view('dashboard.index', compact(
            'myEvents', 
            'todayEvents', 
            'pendingInvitations', 
            'stats'
        ));
    }
}