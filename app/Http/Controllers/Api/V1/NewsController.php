<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/news/latest",
     *      operationId="getLatestNews",
     *      tags={"News"},
     *      summary="Get latest list of news",
     *      description="Returns latest list of news",
     *     @OA\Parameter(
     *          name="limit",
     *          description="List limit",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/NewsCollection")
     *       )
     * )
     */
    public function latest(Request $request)
    {
        $limit = (int) $request->get('limit', 5);

        $newsList = News::query()
                        ->whereLocale(app()->getLocale())
                        ->where('status', EntityStatus::PUBLISHED)
                        ->latest('published_at')
                        ->limit($limit)
                        ->get();

        return NewsResource::collection($newsList);
    }

    /**
     * @OA\Get(
     *      path="/news",
     *      operationId="getNewsList",
     *      tags={"News"},
     *      summary="Get list of news",
     *      description="Returns list of news",
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
     *          @OA\JsonContent(ref="#/components/schemas/NewsPagination")
     *       )
     * )
     */
    public function newsList(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);

        $newsList = News::query()
            ->whereLocale(app()->getLocale())
            ->where('status', EntityStatus::PUBLISHED)
            ->latest('published_at')
            ->paginate($perPage);

        return NewsResource::collection($newsList);
    }

    /**
     * @OA\Get(
     *      path="/news/{id}",
     *      operationId="getNewsById",
     *      tags={"News"},
     *      summary="Get news by id",
     *      description="Return news by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="News id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/NewsResource")
     *       )
     * )
     */
    public function newItem($id)
    {
        $newsItem = News::query()->findOrFail($id);

        return new NewsResource($newsItem);
    }
}
