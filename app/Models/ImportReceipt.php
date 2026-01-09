<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportReceipt extends Model
{
    use HasFactory;

    protected $table = 'import_receipt';
    protected $primaryKey = 'receipt_id';

    protected $fillable = [
        'supplier_id',
        'created_by',
        'confirmed_by',
        'content',
        'quantity',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirmed_by', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(ImportReceiptDetail::class, 'receipt_id', 'receipt_id');
    }

    public function getRouteKeyName()
    {
        return 'receipt_id';
    }
}
