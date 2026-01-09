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
        Schema::create('cart_item', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->foreignId('cart_id')->nullable()->index();
            $table->foreignId('variant_id')->nullable()->index();
            $table->foreignId('product_id')->nullable()->index();
            $table->integer('quantity')->default(0);
            $table->integer('unit_price')->default(0);
            $table->integer('total_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item');
    }
};
