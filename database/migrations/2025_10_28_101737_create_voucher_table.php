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
        Schema::create('voucher', function (Blueprint $table) {
            $table->id('voucher_id');
            $table->string('voucher_code', 50)->unique();
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('discount_percentage')->nullable();
            $table->decimal('max_discount_value', 10, 2)->nullable();
            $table->text('usage_conditions')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};