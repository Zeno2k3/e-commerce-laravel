<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'review';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
    protected $primaryKey = 'review_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'content',
        'review_date',
    ];

    protected $casts = [
        'review_date' => 'datetime',
        'rating' => 'integer',
    ];

    /**
     * Quan hệ: review thuộc về user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ: review thuộc về product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
