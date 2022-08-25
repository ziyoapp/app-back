<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Bonus;
use App\Models\User;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->where('role_id', UserRole::USER)->get()->each(function ($user) {
            $user->bonus()->create(Bonus::factory()->make()->toArray());
        });
    }
}
