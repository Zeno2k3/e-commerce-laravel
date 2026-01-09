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
        Schema::create('import_receipt', function (Blueprint $table) {
            $table->id('receipt_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->text('content')->nullable();
            $table->integer('quantity')->default(0);
            $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();

            $table->foreign('supplier_id')
                ->references('supplier_id')
                ->on('supplier')
                ->onDelete('cascade');
            
            $table->foreign('created_by')
                ->references('user_id')
                ->on('user')
                ->onDelete('cascade');

            $table->foreign('confirmed_by')
                ->references('user_id')
                ->on('user')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_receipt');
    }
};
