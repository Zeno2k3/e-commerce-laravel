<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
     //
    use HasFactory;
    /**
     * Tên bảng trong database
     *
     * @var string
     */
    protected $table = 'favorite';

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
    public $incrementing = false;
    protected $primaryKey = null;

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public $timestamps=true;
    /**
     * Quan hệ với bảng User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ với bảng Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
