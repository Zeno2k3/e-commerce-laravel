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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id('nguoidung_id');
            $table->string('hoten', 255);
            $table->string('email', 255)->unique();
            $table->string('matkhau', 255);
            $table->string('sodienthoai', 20)->nullable();
            $table->enum('vaitro', ['user', 'employee', 'admin'])->default('user');
            $table->enum('trangthai', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};