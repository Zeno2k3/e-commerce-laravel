<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     //
     //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */

    protected $primaryKey = 'order_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'voucher_id',
        'order_date',
        'shipping_fee',
        'note',
        'status',
    ];

    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'voucher_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    /**
     * Tính total_price động từ orderDetails
     */
    public function getTotalPriceAttribute()
    {
        return $this->orderDetails->sum('total_price');
    }

    public function getRouteKeyName()
    {
        return 'order_id';
    }
}
