<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();
        
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }
        
        $users = $query->orderBy('role')->orderBy('name')->paginate(20);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,dosen,mahasiswa',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nomor_hp' => 'nullable|string|max:20',
            'nomor_whatsapp' => 'nullable|string|max:20',
            
            'nim' => 'required_if:role,mahasiswa|nullable|string|unique:users',
            'prodi' => 'required_if:role,mahasiswa|nullable|string',
            'angkatan' => 'required_if:role,mahasiswa|nullable|string',
            
            'nip' => 'required_if:role,dosen|nullable|string|unique:users',
            'nidn' => 'nullable|string|unique:users',
            'homebase' => 'required_if:role,dosen|nullable|string',
            'jabatan_fungsional' => 'nullable|string',
            'bidang_keahlian' => 'nullable|string',
        ]);
        
        $validated['password'] = Hash::make($validated['password']);
        $validated['fakultas'] = 'FILKOM UB';
        
        User::create($validated);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,dosen,mahasiswa',
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nomor_hp' => 'nullable|string|max:20',
            'nomor_whatsapp' => 'nullable|string|max:20',
            
            'nim' => ['required_if:role,mahasiswa', 'nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'prodi' => 'required_if:role,mahasiswa|nullable|string',
            'angkatan' => 'required_if:role,mahasiswa|nullable|string',
            
            'nip' => ['required_if:role,dosen', 'nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'nidn' => ['nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'homebase' => 'required_if:role,dosen|nullable|string',
            'jabatan_fungsional' => 'nullable|string',
            'bidang_keahlian' => 'nullable|string',
        ]);
        
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}