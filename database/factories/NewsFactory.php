<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(60);
        $slug = Str::slug($title);

        return [
            'locale' => 'en',
            'title' => $title,
            'description' => $this->faker->paragraph(5, true),
            'content' => '<p>' . $this->faker->paragraph(15, true) . '</p>',
            'status' => 'publish'
        ];
    }
}
