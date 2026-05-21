<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    // 1. Izinkan pengisian data massal untuk kolom ini
    protected $fillable = [
        'source_device_id',
        'target_device_id',
    ];

    // 2. Relasi ke perangkat sumber (Source)
    public function source()
    {
        return $this->belongsTo(Device::class, 'source_device_id');
    }

    // 3. Relasi ke perangkat tujuan (Target)
    public function target()
    {
        return $this->belongsTo(Device::class, 'target_device_id');
    }
}