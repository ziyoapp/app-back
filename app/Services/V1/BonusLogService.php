<?php

namespace App\Services\V1;

use App\Enums\BonusLogOperation;
use App\Models\Bonus;
use App\Models\BonusLog;
use App\Models\BonusLogProp;

class BonusLogService
{
    public function updateUserBalance(
        int $userId, float $ball, string $type, string $operationType, BonusLogProp $prop, string $comment = null
    ): Bonus {
        $userBall = $ball;

        if ($operationType === BonusLogOperation::ADD) {
            $userBall = abs($ball);
        } else if ($operationType === BonusLogOperation::MINUS) {
            $userBall = abs($ball) * -1;
        }

        $log = BonusLog::create([
            'user_id' => $userId,
            'ball' => $userBall,
            'operation' => $operationType,
            'type' => $type,
            'comment' => $comment
        ]);

        $log->props()->create($prop->toArray());

        $userBalance = Bonus::firstOrCreate([
            'user_id' => $userId
        ]);

        $newBalance = $userBall + $userBalance->ball;
        $userBalance->ball = $newBalance;
        $userBalance->save();

        return $userBalance;
    }
}
