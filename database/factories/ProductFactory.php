<?php

namespace Database\Factories;

use App\Enums\EntityStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->paragraph(1),
            'description' => $this->faker->paragraph(5),
            'price' => $this->faker->randomElement([100, 200, 400, 600, 350, 150]),
            'price_old' => $this->faker->randomElement([400, 500, 700]),
            'quantity' => $this->faker->randomElement([0, 100, 500, 1]),
            'status' => EntityStatus::PUBLISHED
        ];
    }
}
