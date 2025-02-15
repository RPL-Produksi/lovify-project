<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasUuids;


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function mitra()
    {
        return $this->hasOne(User::class, 'mitra_id');
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
