<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'nama_lengkap',
        'role',
        'email',
        'password',
        'nomor_hp',
        'nomor_whatsapp',
        'foto_profil',
        // Mahasiswa
        'nim',
        'prodi',
        'fakultas',
        'angkatan',
        // Dosen
        'nip',
        'nidn',
        'homebase',
        'jabatan_fungsional',
        'bidang_keahlian',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ==================== RELATIONSHIPS ====================
    
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function invitedEvents()
    {
        return $this->belongsToMany(Event::class, 'invitations')
            ->withPivot('status', 'invited_at', 'responded_at')
            ->withTimestamps();
    }

    // ==================== HELPER METHODS ====================
    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDosen(): bool
    {
        return $this->role === 'dosen';
    }

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    public function canCreateEvent(): bool
    {
        return in_array($this->role, ['admin', 'dosen', 'mahasiswa']);
    }

    public function getFotoProfilUrlAttribute(): string
    {
        if ($this->foto_profil && file_exists(storage_path('app/public/' . $this->foto_profil))) {
            return asset('storage/' . $this->foto_profil);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=3B82F6&color=fff';
    }

    public function getRoleBadgeAttribute(): string
    {
        $badges = [
            'admin' => 'bg-blue-100 text-blue-800',
            'dosen' => 'bg-orange-100 text-orange-800',
            'mahasiswa' => 'bg-green-100 text-green-800',
        ];
        
        return $badges[$this->role] ?? 'bg-gray-100 text-gray-800';
    }

    public function getRoleNameAttribute(): string
    {
        $names = [
            'admin' => 'Administrator',
            'dosen' => 'Dosen',
            'mahasiswa' => 'Mahasiswa',
        ];
        
        return $names[$this->role] ?? 'User';
    }
}