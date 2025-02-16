<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'total_price',
        'down_payment',
        'remaining_payment',
        'dp_deadline',
        'payment_deadline',
        'marry_date',
        'status',
        'planning_id',
    ];

    protected $casts = [
        'dp_deadline' => 'date',
        'payment_deadline' => 'date',
        'marry_date' => 'date',
    ];

    protected $hidden = [
        'planning_id',
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'planning',
        'orderProgress'
    ];

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function orderProgress()
    {
        return $this->hasMany(OrderProgress::class);
    }

}
