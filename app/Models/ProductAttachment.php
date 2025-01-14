<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    use HasUuids;

    protected $hidden = [
        'created_at',
        'updated_at',
        'product_id',
    ];
}
