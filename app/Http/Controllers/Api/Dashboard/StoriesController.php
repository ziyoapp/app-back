<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\StoryRequest;
use App\Http\Requests\StoryUpdateRequest;
use App\Http\Resources\StoriesResource;
use App\Models\Story;
use App\Services\StoriesService;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    /**
     * @OA\Get(
     *      path="/dashboard/stories",
     *      operationId="getDashStoriesList",
     *      tags={"Dashboard Stories"},
     *      summary="Get stories list",
     *      description="Return stories list",
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardStoriesPagination")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function list(ListRequest $request, StoriesService $storiesService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $stories = $storiesService->list($perPage, $sort);

        return StoriesResource::collection($stories);
    }

    /**
     * @OA\Get(
     *      path="/dashboard/stories/{id}",
     *      operationId="getDashStoryById",
     *      tags={"Dashboard Stories"},
     *      summary="Get story by id",
     *      description="Return story by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Story id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardStoriesResource")
     *       )
     * )
     */
    public function getItem(int $storyId)
    {
        $story = Story::withoutGlobalScope('published')->findOrFail($storyId);

        return new StoriesResource($story);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/stories",
     *      operationId="createStoriesDash",
     *      tags={"Dashboard Stories"},
     *      summary="Create story",
     *      description="Create story",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardStoriesRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardStoriesResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function create(StoryRequest $request, StoriesService $storiesService)
    {
        $story = $storiesService->create($request->validated());

        return new StoriesResource($story);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/stories/{id}",
     *      operationId="updateStoriesDash",
     *      tags={"Dashboard Stories"},
     *      summary="Update story",
     *      description="Update story",
     *     @OA\Parameter(
     *          name="id",
     *          description="Story id",
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
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardStoriesRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardStoriesResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function update(int $storyId, StoryUpdateRequest $request, StoriesService $storiesService)
    {
        $story = $storiesService->update($storyId, $request->validated());
        return new StoriesResource($story);
    }

    /**
     * @OA\Delete(
     *      path="/dashboard/stories/{id}",
     *      operationId="deleteStoriesById",
     *      tags={"Dashboard Stories"},
     *      summary="Delete story by id",
     *      description="Delete story by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Story id",
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
    public function delete(int $storyId)
    {
        $story = Story::withoutGlobalScope('published')->findOrFail($storyId);
        $story->delete();

        return response()->json();
    }
}
