<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'discount_percentage',
        'rating',
        'stock',
        'brand',
        'category',
        'thumbnail',
        'images',
    ];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'rating' => 'decimal:2',
        'images' => 'json',
    ];
}
