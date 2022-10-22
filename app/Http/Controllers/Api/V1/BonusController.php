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
    /**
     * @OA\Get(
     *      path="/user/bonus",
     *      operationId="getUserBonus",
     *      tags={"User"},
     *      summary="Get user bonus",
     *      description="Get user bonus",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserBonusResource")
     *       )
     * )
     */
    public function getUserBonus()
    {
        $userBonus = Bonus::query()
                            ->select(['ball'])
                            ->where('user_id', auth()->id())
                            ->first();

        return new BonusResource($userBonus);
    }

    /**
     * @OA\Get(
     *      path="/user/bonus-history",
     *      operationId="getBonusHistory",
     *      tags={"User"},
     *      summary="Get list of bonus history",
     *      description="Returns list of bonus history",
     *     @OA\Parameter(
     *          name="page",
     *          description="Page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="per_page",
     *          description="Per page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BonusHistoryPagination")
     *       )
     * )
     */
    public function userBonusHistory(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);

        $history = BonusLog::query()->where('user_id', auth()->id())->orderByDesc('id')->paginate($perPage);
        return BonusHistoryResource::collection($history);
    }
}
