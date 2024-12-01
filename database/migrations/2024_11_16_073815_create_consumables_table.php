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
        Schema::create('consumables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer('stock');
            $table->integer('reorder_level');
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });

        // Tambahkan foreign key jika tabel consumable_categories ada
        if (Schema::hasTable('consumable_categories')) {
            Schema::table('consumables', function (Blueprint $table) {
                $table->foreign('category_id')
                    ->references('id')
                    ->on('consumable_categories')
                    ->onDelete('cascade');
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumables');
    }
};
