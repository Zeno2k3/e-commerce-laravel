<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'title',
        'content',
        'type',
        'event_id',
        'voucher_id',
        'created_by',
    ];

    public function event()
    {
        return $this->belongsTo(PromotionEvent::class, 'event_id', 'event_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'voucher_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'notification_id';
    }
}
