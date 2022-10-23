<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            BonusSeeder::class,
            BonusLogSeeder::class,
        ]);
    }
}
