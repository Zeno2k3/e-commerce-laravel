<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportReceiptDetail extends Model
{
    use HasFactory;

    protected $table = 'import_receipt_detail';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'receipt_id',
        'variant_id',
        'quantity',
        'unit_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function receipt()
    {
        return $this->belongsTo(ImportReceipt::class, 'receipt_id', 'receipt_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
