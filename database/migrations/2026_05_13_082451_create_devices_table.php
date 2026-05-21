<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama perangkat
            $table->string('ip_address')->unique(); // Alamat IP untuk di-ping
            $table->enum('type', ['router', 'switch', 'client'])->default('router');
            $table->decimal('latitude', 10, 8)->nullable(); // Titik koordinat peta
            $table->decimal('longitude', 11, 8)->nullable(); // Titik koordinat peta
            $table->boolean('is_online')->default(false); // Status Up/Down
            $table->string('bandwidth_capacity')->nullable();
            $table->timestamp('last_checked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
