<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'client_id',
    ];

    protected $with = [
        'products'
    ];

    protected $hidden = [
        'client_id',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_planning', 'planning_id', 'product_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'planning_id');
    }
}
