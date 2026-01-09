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
        Schema::create('notification', function (Blueprint $table) {
            $table->id('notification_id');
            $table->string('title', 255);
            $table->text('content');
            $table->enum('type', ['promotion', 'policy', 'general'])->default('general');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('event_id')
                ->references('event_id')
                ->on('promotion_event')
                ->onDelete('set null');

            $table->foreign('voucher_id')
                ->references('voucher_id')
                ->on('voucher')
                ->onDelete('set null');

            $table->foreign('created_by')
                ->references('user_id')
                ->on('user')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
