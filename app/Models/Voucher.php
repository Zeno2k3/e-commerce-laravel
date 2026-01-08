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
     * Khóa chính của bảng
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
    public $timestamps = true;

    /**
     * Relationship: Voucher has many usages
     */
    public function usages()
    {
        return $this->hasMany(VoucherUsage::class, 'voucher_id', 'voucher_id');
    }

    /**
     * Scope: Lấy voucher còn active
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope: Lấy voucher còn hạn sử dụng
     */
    public function scopeValid($query)
    {
        return $query->where('start_date', '<=', now())
                     ->where('end_date', '>=', now())
                     ->where('quantity', '>', 0);
    }

    /**
     * Kiểm tra voucher có còn sử dụng được không
     */
    public function isUsable(): bool
    {
        return $this->status 
            && $this->quantity > 0 
            && $this->start_date <= now() 
            && $this->end_date >= now();
    }

    /**
     * Get the route key for the model (Route Model Binding)
     */
    public function getRouteKeyName(): string
    {
        return 'voucher_id';
    }
}
