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

            $productCategory->products()->sync($products->pluck('id'));
        });
    }
}
