<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class CustomizeController extends Controller
{
    public function index() {
        $devices = Device::all();
        return view('customize', compact('devices'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip|unique:devices',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Device::create($request->all());
        return back()->with('success', 'Perangkat berhasil ditambahkan');
    }

    public function destroy(Device $device) {
        $device->delete();
        return back()->with('success', 'Perangkat berhasil dihapus');
    }
}
