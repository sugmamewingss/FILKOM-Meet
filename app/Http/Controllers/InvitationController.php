<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        $invitations = Invitation::where('user_id', $user->id)
            ->with(['event.creator'])
            ->orderByRaw("FIELD(status, 'pending', 'accepted', 'declined')")
            ->orderBy('invited_at', 'desc')
            ->paginate(15);
        
        return view('invitations.index', compact('invitations'));
    }

    public function accept(Invitation $invitation)
    {
        if ($invitation->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak menerima undangan ini.');
        }
        
        $invitation->accept();
        
        return back()->with('success', 'Undangan berhasil diterima!');
    }

    public function decline(Invitation $invitation)
    {
        if ($invitation->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak menolak undangan ini.');
        }
        
        $invitation->decline();
        
        return back()->with('success', 'Undangan telah ditolak.');
    }
}