<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'mitra_id',
        'profile',
        'category_id'
    ];

    protected $with = [
        'mitra',
        'products',
        'category'
    ];

    protected $hidden = [
        'mitra_id',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
