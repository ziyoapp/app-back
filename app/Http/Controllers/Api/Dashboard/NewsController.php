<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/dashboard/news/{id}",
     *      operationId="getDashNewsById",
     *      tags={"Dashboard News"},
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardNewsResource")
     *       )
     * )
     */
    public function item(int $newsId)
    {
        $news = News::findOrFail($newsId);
        return new NewsResource($news);
    }

    /**
     * @OA\Get(
     *      path="/dashboard/news/list",
     *      operationId="getDashNewsList",
     *      tags={"Dashboard News"},
     *      summary="Get news list",
     *      description="Return news list",
     *     @OA\Parameter(
     *          name="sort",
     *          description="Sort by published at [asc, desc]",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardNewsCollection")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function list(ListRequest $request, NewsService $newsService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $newsList = $newsService->list($perPage, $sort);

        return NewsResource::collection($newsList);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/news",
     *      operationId="createNewsDash",
     *      tags={"Dashboard News"},
     *      summary="Create news",
     *      description="Create news",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardNewsRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardNewsResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function create(NewsCreateRequest $request, NewsService $newsService)
    {
        $validatedData = $request->validated();
        $news = $newsService->create($validatedData);

        return new NewsResource($news);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/news/{id}",
     *      operationId="UpdateNewsDash",
     *      tags={"Dashboard News"},
     *      summary="Update news",
     *      description="Update news",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardNewsRequest")
     *         )
     *      ),
     *     @OA\Parameter(
     *          name="id",
     *          description="News id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="_method",
     *          description="HTTP PUT: [only - PUT]",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardNewsResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function update(int $newsId, NewsUpdateRequest $request, NewsService $newsService)
    {
        $validatedData = $request->validated();
        $news = $newsService->update($newsId, $validatedData);

        return new NewsResource($news);
    }

    /**
     * @OA\Delete(
     *      path="/dashboard/news/{id}",
     *      operationId="deleteDashNewsById",
     *      tags={"Dashboard News"},
     *      summary="Delete news by id",
     *      description="Delete news by id",
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
     *          description="Successful operation"
     *       )
     * )
     */
    public function delete(int $newsId)
    {
        $news = News::findOrFail($newsId);
        $news->delete();
        return response()->json();
    }
}
