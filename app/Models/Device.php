<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ip_address', 'type', 'latitude', 'longitude', 'is_online', 'bandwidth_capacity', 'last_checked', 'region'
    ];
}