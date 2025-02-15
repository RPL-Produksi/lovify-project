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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'planning_products', 'planning_id', 'product_id');
    }
}
