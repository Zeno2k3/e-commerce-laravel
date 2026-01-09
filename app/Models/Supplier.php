<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function importReceipts()
    {
        return $this->hasMany(ImportReceipt::class, 'supplier_id', 'supplier_id');
    }

    public function getRouteKeyName()
    {
        return 'supplier_id';
    }
}
