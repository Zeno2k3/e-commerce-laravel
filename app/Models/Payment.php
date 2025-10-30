<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Payment extends Model
{
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'payment';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */

    protected $primaryKey = 'payment_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'method',
        'status',
        'payment_date',
    ];

    public $timestamps=true;
    protected $casts = [
        'payment_date' => 'date',
    ];

    /**
     * Quan hệ: Mỗi payment thuộc về 1 order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
