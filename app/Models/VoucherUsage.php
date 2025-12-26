<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'voucher_usage';


    /**
     * Tắt auto-increment vì đây là composite key
     * @var string
     */
    public $incrementing = false;

    /**
     * Loại khóa chính (do composite key không phải kiểu int)
     */
    protected $keyType = 'string';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'user_id',
        'voucher_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ: 1 usage thuộc về 1 voucher
     */
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'voucher_id');
    }



}
