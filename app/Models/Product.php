<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'category_id',
        'slug',
        'name',
        'description',
        'price',
        'stock',
        'mitra_id',
        'cover',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }

    public function packets()
    {
        return $this->belongsToMany(Packet::class, 'product_packet', 'product_id', 'packet_id');
    }
}
