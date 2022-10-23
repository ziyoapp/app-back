<?php

namespace Database\Seeders;

use App\Enums\BonusLogOperation;
use App\Enums\BonusLogType;
use App\Enums\UserRole;
use App\Models\Bonus;
use App\Models\BonusLog;
use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class BonusLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->where('role_id', UserRole::USER)->get()->each(function ($user) {
            BonusLog::factory(3)->create([
                'user_id' => $user->id
            ]);

            BonusLog::factory(2)->create([
                'user_id' => $user->id,
                'ball' => -250,
                'operation' => BonusLogOperation::MINUS,
                'type' => BonusLogType::PRODUCT
            ]);

            BonusLog::query()
                ->where('user_id', $user->id)
                ->where('type', BonusLogType::EVENT)
                ->get()
                ->each(function ($bonus_log) {
                    $bonus_log->props()->create([
                        'entity_type' => Event::class,
                        'entity_id' => Event::query()->inRandomOrder()->first()->id
                    ]);
                });

            BonusLog::query()
                ->where('user_id', $user->id)
                ->where('type', BonusLogType::PRODUCT)
                ->get()
                ->each(function ($bonus_log) {
                    $bonus_log->props()->create([
                        'entity_type' => Product::class,
                        'entity_id' => Product::query()->inRandomOrder()->first()->id
                    ]);
                });
        });
    }
}
