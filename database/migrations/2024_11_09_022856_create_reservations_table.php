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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->foreignId('guest_id')->constrained('guests', 'guest_id')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms', 'room_id')->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->enum('status', ['reserved', 'checked_in', 'checked_out', 'cancelled'])->default('reserved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
