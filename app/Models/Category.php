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

    /**
     * Khóa chính của bảngApp\Models\Category::all();
     *
     * @var string
     */
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

    public function getRouteKeyName()
    {
        return 'category_id';
    }
}
