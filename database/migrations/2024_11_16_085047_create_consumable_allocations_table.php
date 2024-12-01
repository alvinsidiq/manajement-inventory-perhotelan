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
        Schema::create('consumable_allocations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('consumable_id'); // Foreign key barang consumable
            $table->unsignedBigInteger('room_id'); // Foreign key kamar
            $table->unsignedBigInteger('allocated_by'); // Foreign key karyawan
            $table->integer('quantity'); // Jumlah barang
            $table->timestamp('allocated_at'); // Waktu alokasi
            $table->string('status')->default('dalam pemakaian'); // Status alokasi
            $table->timestamps();

            // Foreign Key Constraints
            if (Schema::hasTable('consumables')) {
                $table->foreign('consumable_id')->references('id')->on('consumables')->onDelete('cascade');
            }
            if (Schema::hasTable('rooms')) {
                $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade'); // Sesuaikan ke room_id
            }
            if (Schema::hasTable('users')) {
                $table->foreign('allocated_by')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumable_allocations');
    }
};
