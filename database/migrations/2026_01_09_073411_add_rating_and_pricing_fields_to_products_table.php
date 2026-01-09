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
            // Rating: Điểm trung bình (0-5), mặc định 0
            $table->decimal('rating', 2, 1)->default(0)->after('description');
            
            // Reviews count: Số lượng đánh giá
            $table->unsignedInteger('reviews_count')->default(0)->after('rating');
            
            // Discount percentage: % giảm giá (0-100), null = không giảm
            $table->decimal('discount_percentage', 5, 2)->nullable()->after('reviews_count');
            
            // Old price: Giá gốc trước khi giảm (dùng để hiển thị giá gạch ngang)
            $table->decimal('old_price', 15, 2)->nullable()->after('discount_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['rating', 'reviews_count', 'discount_percentage', 'old_price']);
        });
    }
};
