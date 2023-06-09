<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BonusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ball' => $this->faker->numberBetween(0, 1500)
        ];
    }
}
