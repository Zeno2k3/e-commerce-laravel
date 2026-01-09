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
        Schema::table('product', function (Blueprint $table) {
            // Thêm field product_type: nam, nu, phu-kien
            $table->enum('product_type', ['nam', 'nu', 'phu-kien'])
                  ->default('nam')
                  ->after('category_id')
                  ->comment('Loại sản phẩm: nam, nu, phu-kien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }
};
