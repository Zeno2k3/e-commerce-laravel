<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'category_product';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
    /**
     * Tắt auto-increment vì bảng này dùng composite key
     */
    public $incrementing = false;

    /**
     * Loại khóa chính
     */
    protected $keyType = 'string';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'category_id',
        'product_id',
    ];

    public $timestamps=true;
     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * Quan hệ: Nhiều bản ghi thuộc về 1 product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
