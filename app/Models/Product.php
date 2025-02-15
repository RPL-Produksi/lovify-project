<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'cover',
        'status',
        'vendor_id'
    ];

    protected $with = [
        'attachments',
        'vendor'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function plannings()
    {
        return $this->belongsToMany(Planning::class, 'product_planning', 'product_id', 'planning_id');
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
