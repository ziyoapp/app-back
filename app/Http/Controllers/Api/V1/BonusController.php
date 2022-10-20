<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BonusHistoryResource;
use App\Http\Resources\V1\BonusResource;
use App\Models\Bonus;
use App\Models\BonusLog;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function getUserBonus()
    {
        $userBonus = Bonus::query()
                            ->select(['ball'])
                            ->where('user_id', auth()->id())
                            ->first();

        return new BonusResource($userBonus);
    }

    public function userBonusHistory(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);

        $history = BonusLog::query()->where('user_id', auth()->id())->orderByDesc('id')->paginate($perPage);
        return BonusHistoryResource::collection($history);
    }
}
