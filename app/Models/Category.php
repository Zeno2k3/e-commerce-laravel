<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'description',
    ];

    public $timestamps=true;

    /**
     * Quan hệ: Mỗi danh mục có nhiều sản phẩm
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'category_id';
    }
}
