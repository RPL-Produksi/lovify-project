<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasUuids;
    private $with = ['products'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_packet', 'packet_id', 'product_id');
    }
}
