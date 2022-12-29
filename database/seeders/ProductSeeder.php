<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::all()->each(function (ProductCategory $productCategory) {
            $products = Product::factory(5)->create();

            $products->each(function ($product) {
                for ($i = 0; $i < 3; $i++) {
                    $product->addMediaFromUrl('https://dummyimage.com/360x260')->toMediaCollection('default');
                }
            });

            $productCategory->products()->sync($products->pluck('id'));
        });
    }
}
