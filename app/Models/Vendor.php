<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'mitra_id',
        'profile'
    ];

    protected $with = [
        'mitra'
    ];

    public function mitra()
    {
        return $this->belongsTo(User::class, 'mitra_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
