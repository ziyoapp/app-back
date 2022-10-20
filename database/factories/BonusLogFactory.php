<?php

namespace Database\Factories;

use App\Enums\BonusLogOperation;
use App\Enums\BonusLogType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BonusLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'ball' => $this->faker->numberBetween(-500, 1000),
            'operation' => BonusLogOperation::ADD,
            'type' => BonusLogType::EVENT,
            'comment' => null
        ];
    }
}
