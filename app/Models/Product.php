<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'old_price',
        'discount_percentage',
        'available_sizes',
        'primary_image',
        'is_sold_out',
        'is_featured',
        'is_new_arrival',
        'view_count'
    ];

    protected $casts = [
        'available_sizes' => 'array',
        'is_sold_out' => 'boolean',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}