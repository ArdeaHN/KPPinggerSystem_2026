<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'source_device_id' => 'required|exists:devices,id',
            'target_device_id' => 'required|exists:devices,id|different:source_device_id',
        ]);

        if ($user->role !== 'Super Admin') {
            $sourceDevice = Device::findOrFail($request->source_device_id);
            if ($sourceDevice->region !== $user->region_access) {
                return back()->with('error', 'Akses ditolak! Anda hanya bisa menyambungkan perangkat milik OPD/Wilayah Anda.');
            }
        }

        Link::create([
            'source_device_id' => $request->source_device_id,
            'target_device_id' => $request->target_device_id,
        ]);

        return back()->with('success', 'Jalur koneksi berhasil ditambahkan!');
    }

    // --- FUNGSI BARU UNTUK TAMPILAN EDIT KONEKSI ---
    public function edit(Link $link)
    {
        $user = Auth::user();
        $sourceDevice = Device::findOrFail($link->source_device_id);
        
        if ($user->role !== 'Super Admin' && $sourceDevice->region !== $user->region_access) {
            return back()->with('error', 'Akses ditolak! Anda tidak berhak mengedit koneksi ini.');
        }

        if ($user->role === 'Super Admin') {
            $devices = Device::orderBy('created_at', 'desc')->get();
            $targetDevices = $devices;
        } else {
            $devices = Device::where('region', $user->region_access)->orderBy('created_at', 'desc')->get();
            $targetDevices = Device::orderBy('name', 'asc')->get();
        }

        return view('nodes.edit-link', compact('link', 'devices', 'targetDevices'));
    }

    // --- FUNGSI BARU UNTUK PROSES UPDATE KONEKSI ---
    public function update(Request $request, Link $link)
    {
        $user = Auth::user();
        $request->validate([
            'source_device_id' => 'required|exists:devices,id',
            'target_device_id' => 'required|exists:devices,id|different:source_device_id',
        ]);

        if ($user->role !== 'Super Admin') {
            $sourceDevice = Device::findOrFail($request->source_device_id);
            if ($sourceDevice->region !== $user->region_access) {
                return back()->with('error', 'Akses ditolak! Anda hanya bisa menyambungkan perangkat milik OPD/Wilayah Anda.');
            }
        }

        $link->update([
            'source_device_id' => $request->source_device_id,
            'target_device_id' => $request->target_device_id,
        ]);

        return redirect()->route('nodes.index')->with('success', 'Koneksi jaringan berhasil diperbarui!');
    }

    public function destroy(Link $link)
    {
        $user = Auth::user();
        if ($user->role !== 'Super Admin') {
            $sourceDevice = Device::findOrFail($link->source_device_id);
            if ($sourceDevice->region !== $user->region_access) {
                return back()->with('error', 'Akses ditolak! Anda tidak berhak memutus koneksi ini.');
            }
        }

        $link->delete();
        return back()->with('success', 'Jalur koneksi berhasil diputus!');
    }
}