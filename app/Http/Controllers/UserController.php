<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. Tampilkan Daftar Pengguna
    public function index()
    {
        $users = User::all();
        // Ambil data wilayah, urutkan sesuai abjad
        $regions = Region::orderBy('name', 'asc')->get(); 
        
        // Kirimkan variabel $regions ke view
        return view('users.index', compact('users', 'regions')); 
    }

    // 2. Simpan Pengguna Baru
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'Super Admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak! Hanya Super Admin yang dapat menambah pengguna.');
        }

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8',
            'role'          => 'required|string',
            'region_access' => 'nullable|string|max:255',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password), // Enkripsi password
            'role'          => $request->role,
            'region_access' => $request->region_access,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    // 3. Tampilkan Halaman Edit
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'Super Admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak! Hanya Super Admin yang dapat mengedit pengguna.');
        }

        // Ambil data wilayah untuk dropdown di halaman edit
        $regions = Region::orderBy('name', 'asc')->get(); 

        return view('users.edit', compact('user', 'regions'));
    }

    // 4. Simpan Perubahan Edit (Update)
    public function update(Request $request, User $user)
    {
        if (Auth::user()->role !== 'Super Admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $user->id,
            'role'          => 'required|string',
            'region_access' => 'nullable|string|max:255',
            'password'      => 'nullable|string|min:8', // Nullable karena bersifat opsional
        ]);

        $dataUpdate = [
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'region_access' => $request->region_access,
        ];

        // Jika kolom ganti password diisi oleh Super Admin
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataUpdate);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // 5. Hapus Pengguna
    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'Super Admin') {
            return redirect()->route('users.index')->with('error', 'Akses ditolak!');
        }

        // Mencegah Super Admin menghapus akunnya sendiri secara tidak sengaja
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif!');
        }

        $user->delete();
        return back()->with('success', 'Akun pengguna berhasil dihapus!');
    }
}