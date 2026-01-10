<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'order_detail';
    public $incrementing = false;

    /**
     * Loại khóa chính
     *
     */
    protected $keyType = 'string';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'variant_id',
        'quantity',
        'unit_price',
        'total_price',
    ];
     public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * Quan hệ: Mỗi chi tiết thuộc về 1 sản phẩm biến thể
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }

}
