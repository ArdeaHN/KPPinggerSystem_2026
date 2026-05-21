<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'Super Admin') {
            $devices = Device::orderBy('created_at', 'desc')->get();
            $targetDevices = $devices; 
            $links = Link::with(['source', 'target'])->get();
        } else {
            $devices = Device::where('region', $user->region_access)->orderBy('created_at', 'desc')->get();
            $targetDevices = Device::orderBy('name', 'asc')->get(); 
            $links = Link::whereHas('source', function($query) use ($user) {
                $query->where('region', $user->region_access);
            })->with(['source', 'target'])->get();
        }

        return view('nodes.index', compact('devices', 'targetDevices', 'links'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'ip_address' => 'required|ip|unique:devices,ip_address',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        Device::create([
            'name'       => $request->name,
            'ip_address' => $request->ip_address,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
            'is_online'  => false,
            'region'     => $user->region_access,
        ]);

        return back()->with('success', 'Perangkat jaringan berhasil ditambahkan ke wilayah Anda!');
    }

    // --- FUNGSI BARU UNTUK TAMPILAN EDIT ---
    public function edit(Device $device)
    {
        $user = Auth::user();
        if ($user->role !== 'Super Admin' && $device->region !== $user->region_access) {
            return back()->with('error', 'Akses ditolak! Anda tidak berhak mengedit perangkat ini.');
        }
        return view('nodes.edit', compact('device'));
    }

    // --- FUNGSI BARU UNTUK PROSES UPDATE ---
    public function update(Request $request, Device $device)
    {
        $user = Auth::user();
        if ($user->role !== 'Super Admin' && $device->region !== $user->region_access) {
            return back()->with('error', 'Akses ditolak! Anda tidak berhak mengedit perangkat ini.');
        }

        $request->validate([
            'name'       => 'required|string|max:255',
            'ip_address' => 'required|ip|unique:devices,ip_address,' . $device->id, // Pengecualian unik untuk ID ini
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        $device->update([
            'name'       => $request->name,
            'ip_address' => $request->ip_address,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
        ]);

        return redirect()->route('nodes.index')->with('success', 'Perangkat berhasil diperbarui!');
    }

    public function destroy(Device $device)
    {
        $user = Auth::user();
        if ($user->role !== 'Super Admin' && $device->region !== $user->region_access) {
            return back()->with('error', 'Akses ditolak! Anda tidak berhak menghapus perangkat ini.');
        }

        $device->delete();
        return back()->with('success', 'Perangkat berhasil dihapus dari sistem!');
    }
}