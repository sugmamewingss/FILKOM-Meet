<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul_event',
        'deskripsi_event',
        'jenis_event',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'sks',
        'lokasi',
        'mode_event',
        'created_by',
        'visibility',
        'meeting_link',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'datetime',
            'tanggal_selesai' => 'datetime',
            'sks' => 'decimal:1',
            'durasi' => 'integer',
        ];
    }

    // ==================== RELATIONSHIPS ====================

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'invitations')
            ->withPivot('status', 'invited_at', 'responded_at')
            ->withTimestamps();
    }

    public function acceptedParticipants()
    {
        return $this->participants()->wherePivot('status', 'accepted');
    }

    public function pendingParticipants()
    {
        return $this->participants()->wherePivot('status', 'pending');
    }

    public function declinedParticipants()
    {
        return $this->participants()->wherePivot('status', 'declined');
    }

    // ==================== HELPER METHODS ====================

    public function isOwner(?User $user): bool
    {
        if (!$user) return false;
        return $this->created_by === $user->id;
    }

    public function isParticipant(?User $user): bool
    {
        if (!$user) return false;
        return $this->participants()->where('user_id', $user->id)->exists();
    }

    public function getDurationInMinutesAttribute(): int
    {
        if ($this->durasi) {
            return $this->durasi;
        }
        return $this->tanggal_mulai->diffInMinutes($this->tanggal_selesai);
    }

    public function getFormattedDateAttribute(): string
    {
        Carbon::setLocale('id');
        $start = $this->tanggal_mulai->translatedFormat('d F Y, H:i');
        $end = $this->tanggal_selesai->format('H:i');
        return "{$start} - {$end} WIB";
    }

    public function getShortDateAttribute(): string
    {
        Carbon::setLocale('id');
        return $this->tanggal_mulai->translatedFormat('d M Y');
    }

    public function getTimeRangeAttribute(): string
    {
        $start = $this->tanggal_mulai->format('H:i');
        $end = $this->tanggal_selesai->format('H:i');
        return "{$start} - {$end}";
    }

    public function isUpcoming(): bool
    {
        return $this->tanggal_mulai->isFuture();
    }

    public function isOngoing(): bool
    {
        return Carbon::now()->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    public function isPast(): bool
    {
        return $this->tanggal_selesai->isPast();
    }

    public function getStatusAttribute(): string
    {
        if ($this->isOngoing()) return 'ongoing';
        if ($this->isUpcoming()) return 'upcoming';
        if ($this->isPast()) return 'past';
        return 'unknown';
    }

    public function getStatusBadgeAttribute(): string
    {
        if ($this->isOngoing()) {
            return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Sedang Berlangsung</span>';
        } elseif ($this->isUpcoming()) {
            return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Akan Datang</span>';
        } else {
            return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Selesai</span>';
        }
    }

    public function getModeBadgeAttribute(): string
    {
        $badges = [
            'online' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Online</span>',
            'offline' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Offline</span>',
            'hybrid' => '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Hybrid</span>',
        ];
        
        return $badges[$this->mode_event] ?? '';
    }
}