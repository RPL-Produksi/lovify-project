<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;

    // $table->uuid('id')->primary();
    // $table->foreignUuid('mitra_id')->constrained('users')->cascadeOnDelete();
    // $table->string('name');
    // $table->text('description');
    // $table->integer('price');
    // $table->string('cover');
    // $table->enum('status', ['draft', 'active', 'inactive'])->default('draft');
    // $table->uuid('id')->primary();
    // $table->foreignUuid('product_id')->constrained('products')->cascadeOnDelete();
    // $table->string('image_path');
    // $table->timestamps();
    protected $fillable = [
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

    protected $with = [
        'attachments',
        'user',
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
}
