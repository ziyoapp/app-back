<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BonusResource;
use App\Models\Bonus;
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
}
