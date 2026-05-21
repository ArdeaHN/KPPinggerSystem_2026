<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Link;

class DashboardController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        $links = Link::with(['source', 'target'])->get();
        return view('dashboard', compact('devices', 'links'));
    }
}