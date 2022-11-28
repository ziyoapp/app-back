<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort',
    ];

    protected $hidden = ['pivot'];

    protected $casts = [
        'products_count' => 'integer',
        'sort' => 'integer'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
