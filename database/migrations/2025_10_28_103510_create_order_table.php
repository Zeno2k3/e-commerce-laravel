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
        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->dateTime('order_date')->useCurrent();
            $table->decimal('shipping_fee', 10, 2)->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'shipping', 'completed', 'cancelled'])->default('pending');

            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')
                ->references('user_id')
                ->on('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('address_id')
                ->references('address_id')
                ->on('address')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('voucher_id')
                ->references('voucher_id')
                ->on('voucher')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};