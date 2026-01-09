<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'product_variant';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
    protected $primaryKey = 'variant_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'size',
        'color',
        'material',
        'price',
        'stock',
        'url_image',
    ];

    public $timestamps=true;
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

   
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
