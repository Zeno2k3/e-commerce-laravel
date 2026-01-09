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
        Schema::create('import_receipt_detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('variant_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 12, 2);
            $table->timestamps();

            $table->foreign('receipt_id')
                ->references('receipt_id')
                ->on('import_receipt')
                ->onDelete('cascade');

            $table->foreign('variant_id')
                ->references('variant_id')
                ->on('product_variant')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_receipt_detail');
    }
};
