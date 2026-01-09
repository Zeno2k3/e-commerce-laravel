<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionEvent extends Model
{
    use HasFactory;

    protected $table = 'promotion_event';
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'name',
        'description',
        'discount_percent',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_percent' => 'integer',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'event_id', 'event_id');
    }

    /**
     * Scope: Active events
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }

    public function getRouteKeyName()
    {
        return 'event_id';
    }
}
