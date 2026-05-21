<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class NetworkCheckController extends Controller
{
    public function check(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! in_array($user->role, ['Super Admin', 'Admin'])) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menjalankan pengecekan status node.');
        }

        try {
            Artisan::call('network:ping');

            return back()->with('success', 'Pengecekan status node berhasil dijalankan. Data status node telah diperbarui.');
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('error', 'Gagal menjalankan pengecekan status node. Silakan periksa konfigurasi command network:ping.');
        }
    }
}