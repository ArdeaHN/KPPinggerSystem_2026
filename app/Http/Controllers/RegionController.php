<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    // Fungsi bantuan untuk mengecek hak akses
    private function checkSuperAdmin()
    {
        if (Auth::user()->role !== 'Super Admin') {
            abort(403, 'Akses Ditolak! Hanya Super Admin yang diizinkan.');
        }
    }

    public function index()
    {
        $this->checkSuperAdmin();
        $regions = Region::orderBy('name', 'asc')->get();
        return view('regions.index', compact('regions'));
    }

    public function store(Request $request)
    {
        $this->checkSuperAdmin();
        $request->validate(['name' => 'required|string|max:255|unique:regions,name']);
        
        Region::create(['name' => $request->name]);
        return back()->with('success', 'Data OPD / Wilayah berhasil ditambahkan!');
    }

    public function edit(Region $region)
    {
        $this->checkSuperAdmin();
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $this->checkSuperAdmin();
        $request->validate(['name' => 'required|string|max:255|unique:regions,name,' . $region->id]);
        
        $region->update(['name' => $request->name]);
        return redirect()->route('regions.index')->with('success', 'Data OPD / Wilayah berhasil diperbarui!');
    }

    public function destroy(Region $region)
    {
        $this->checkSuperAdmin();
        $region->delete();
        return back()->with('success', 'Data OPD / Wilayah berhasil dihapus permanen!');
    }
}