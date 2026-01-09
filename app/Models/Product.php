<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_code',
        'category_id',
        'product_name',
        'description',
        'rating',
        'reviews_count',
        'discount_percentage',
        'old_price',
        'product_type',
        'status',
    ];

    public $timestamps=true;
    
    /**
     * Cast attributes to appropriate types
     */
    protected $casts = [
        'rating' => 'decimal:1',
        'reviews_count' => 'integer',
        'discount_percentage' => 'decimal:2',
        'old_price' => 'decimal:2',
    ];
    
    /**
     * Accessor: Get discount as formatted string (e.g., "-25%")
     */
    public function getDiscountAttribute(): ?string
    {
        if ($this->discount_percentage > 0) {
            return '-' . number_format($this->discount_percentage, 0) . '%';
        }
        return null;
    }
    
    /**
     * Quan hệ: Mỗi sản phẩm thuộc về một danh mục
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * Quan hệ: Mỗi sản phẩm có nhiều biến thể
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'product_id');
    }

    /**
     * Quan hệ: Mỗi sản phẩm có nhiều đánh giá
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }

}
