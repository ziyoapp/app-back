<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'price',
        'price_old',
        'quantity',
        'sort',
        'status',
    ];

    protected $casts = [
        'price' => 'float',
        'price_old' => 'float',
        'quantity' => 'int',
        'sort' => 'int',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_product');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('products');
    }
}
