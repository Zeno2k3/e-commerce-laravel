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
        Schema::create('product', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('product_name', 255);
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')
                ->references('category_id')
                ->on('category')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};