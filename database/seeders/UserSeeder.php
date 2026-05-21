<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Super Admin
        User::create([
            'name'              => 'Administrator KP',
            'email'             => 'admin@kulonprogo.go.id', // Sesuai placeholder di halaman login
            'email_verified_at' => now(),
            'role'              => 'Super Admin',
            'region_access'     => 'All Kulon Progo',
            'password'          => Hash::make('admin123'), // Password default: admin123
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // 2. Akun Teknisi Lapangan (Contoh tambahan sesuai proposal)
        User::create([
            'name'              => 'Teknisi Wates',
            'email'             => 'teknisi_wates@kulonprogo.go.id',
            'email_verified_at' => now(),
            'role'              => 'Field Engineer',
            'region_access'     => 'Kapanewon Wates',
            'password'          => Hash::make('teknisi123'), // Password default: teknisi123
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}