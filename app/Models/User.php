<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Cho phép dùng hệ thống Auth
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    /**
     * Các cột có thể gán hàng loạt
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone_number',
        'role',
        'status',
    ];

    /**
     * Các cột bị ẩn khi trả về JSON / array
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Ép kiểu dữ liệu cho các cột
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', 
        ];
    }

    public function getRouteKeyName()
    {
        return 'user_id';
    }
}
