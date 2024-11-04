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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id'); // Foreign key ke `categories`
            $table->integer('quantity');
            $table->decimal('unit_price', 8, 2);
            $table->unsignedBigInteger('supplier_id'); // Foreign key ke `suppliers`
            $table->timestamps();


            if (Schema::hasTable('categories')) {
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            }

            if (Schema::hasTable('suppliers')) {
                $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
