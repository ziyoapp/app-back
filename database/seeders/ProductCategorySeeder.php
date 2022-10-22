<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Ziyo Forum',
            'Coca-Cola',
            'Avlod media'
        ];

        foreach ($categories as $category) {
            ProductCategory::factory(1)->create([
                'name' => $category
            ]);
        }
    }
}
