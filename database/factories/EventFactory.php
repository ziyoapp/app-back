<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(60);

        return [
            'title' => $title,
            'description' => $this->faker->paragraph(5, true),
            'content' => '<p>' . $this->faker->paragraph(15, true) . '</p>',
            'address' => $this->faker->streetAddress(),
            'ball' => $this->faker->numberBetween(100, 2500),
            'price_ball' => $this->faker->numberBetween(500, 2500),
            'register_count' => $this->faker->numberBetween(0, 200),
            'date_start_at' => $this->faker->dateTimeBetween('+10 days', '+15 days'),
            'date_end_at' => $this->faker->dateTimeBetween('+20 days', '+25 days'),
            'published_at' => $this->faker->dateTime(),
            'schedule_text' => $this->faker->paragraph(2, true),
            'status' => 'publish'
        ];
    }
}
