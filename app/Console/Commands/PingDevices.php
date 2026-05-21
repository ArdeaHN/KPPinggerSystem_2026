<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Device;

class PingDevices extends Command
{
    protected $signature = 'network:ping';
    protected $description = 'Ping semua perangkat untuk cek status';

    public function handle()
    {
        $devices = Device::all();
        foreach ($devices as $device) {
            $ip = $device->ip_address;

            // Deteksi OS untuk format ping yang sesuai (Laptop Windows vs Server Linux)
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                exec("ping -n 1 -w 1000 " . escapeshellarg($ip), $output, $status);
            } else {
                exec("ping -c 1 -W 1 " . escapeshellarg($ip), $output, $status);
            }

            $isOnline = ($status === 0);
            $device->update([
                'is_online' => $isOnline,
                'last_checked' => now(),
            ]);

            $this->info("Pinged {$device->name} ({$ip}) - " . ($isOnline ? 'ONLINE' : 'OFFLINE'));
        }
    }
}
