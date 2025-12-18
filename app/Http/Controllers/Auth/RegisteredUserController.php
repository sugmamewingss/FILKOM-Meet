<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:dosen,mahasiswa'],
            'name' => ['required', 'string', 'max:255'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nomor_hp' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            'nim' => ['required_if:role,mahasiswa', 'nullable', 'string', 'unique:users'],
            'prodi' => ['required_if:role,mahasiswa', 'nullable', 'string'],
            'angkatan' => ['required_if:role,mahasiswa', 'nullable', 'string'],
            
            'nip' => ['required_if:role,dosen', 'nullable', 'string', 'unique:users'],
            'nidn' => ['nullable', 'string', 'unique:users'],
            'homebase' => ['required_if:role,dosen', 'nullable', 'string'],
        ]);

        $userData = [
            'name' => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'password' => Hash::make($request->password),
            'fakultas' => 'FILKOM UB',
        ];

        if ($request->role === 'mahasiswa') {
            $userData['nim'] = $request->nim;
            $userData['prodi'] = $request->prodi;
            $userData['angkatan'] = $request->angkatan;
        } elseif ($request->role === 'dosen') {
            $userData['nip'] = $request->nip;
            $userData['nidn'] = $request->nidn;
            $userData['homebase'] = $request->homebase;
        }

        $user = User::create($userData);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}