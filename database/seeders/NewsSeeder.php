<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::factory(15)->create([
            'locale' => 'ru'
        ])->each(function ($new) {
            $new->addMediaFromUrl('https://dummyimage.com/360x260')->toMediaCollection();
        });

        News::factory(10)->create([
            'locale' => 'uz'
        ])->each(function ($new) {
            $new->addMediaFromUrl('https://dummyimage.com/360x260')->toMediaCollection();
        });
    }
}
