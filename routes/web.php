<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\NetworkCheckController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); // Langsung arahkan ke login jika buka web pertama kali
});

// Grup Rute Utama (Hanya bisa diakses jika sudah login)
Route::middleware(['auth', 'verified'])->group(function () {
    // 1. Dashboard (Peta)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Manajemen Node & Koneksi
    Route::get('/nodes', [DeviceController::class, 'index'])->name('nodes.index');
    Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update'); 
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
    
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
    Route::get('/links/{link}/edit', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/links/{link}', [LinkController::class, 'update'])->name('links.update'); 
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');

    // 3. Manajemen Pengguna
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // 4. Manajemen Master OPD / Wilayah (Khusus Super Admin)
    Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
    Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
    Route::get('/regions/{region}/edit', [RegionController::class, 'edit'])->name('regions.edit');
    Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');
    Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');

    //5. Check Status
    Route::post('/network/check-status', [NetworkCheckController::class, 'check'])
        ->name('network.check-status');
});

// Grup Rute Profil Bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';