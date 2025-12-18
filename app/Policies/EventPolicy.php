<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function viewAny(?User $user): bool
    {
        return $user !== null;
    }

    public function view(?User $user, Event $event): bool
    {
        if (!$user) return false;
        
        return $user->isAdmin()
            || $event->created_by === $user->id
            || $event->isParticipant($user)
            || $event->visibility === 'public';
    }

    public function create(User $user): bool
    {
        return $user->canCreateEvent();
    }

    public function update(User $user, Event $event): bool
    {
        return $user->isAdmin() || $event->created_by === $user->id;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->isAdmin() || $event->created_by === $user->id;
    }

    public function restore(User $user, Event $event): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Event $event): bool
    {
        return $user->isAdmin();
    }

    public function invite(User $user, Event $event): bool
    {
        return $user->isAdmin() || $event->created_by === $user->id;
    }
}