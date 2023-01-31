<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\StoriesResource;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoriesController extends Controller
{

    /**
     * @OA\Get(
     *      path="/stories",
     *      operationId="getStoriesList",
     *      tags={"Stories"},
     *      summary="Get list of stories",
     *      description="Get list of stories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/StoriesCollection")
     *       )
     * )
     */
    public function getStories()
    {
        $stories = Story::query()
            ->where('status', EntityStatus::PUBLISHED)
            ->where(function ($q) {
                $q->orWhere(function($query) {
                    $query->where('active_start_date', '<=', now()->toDateTimeString())
                        ->where('active_end_date', '>', now()->toDateTimeString());
                })->orWhere(function($query) {
                    $query->orWhereNull('active_start_date')
                        ->orWhereNull('active_end_date');
                });
            })
            ->orderByDesc('sort')
            ->orderByDesc('id')
            ->limit(20)
            ->get();

        return StoriesResource::collection($stories);
    }
}
