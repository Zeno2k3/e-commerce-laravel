<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    // //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'voucher';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
    protected $primaryKey = 'voucher_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'voucher_code',
        'description',
        'quantity',
        'discount_percentage',
        'max_discount_value',
        'usage_conditions',
        'start_date',
        'end_date',
        'status',
    ];

     protected $casts = [
        'status' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'max_discount_value' => 'decimal:2',
    ];
    public $timestamps=true;

}
