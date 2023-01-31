<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @OA\Get(
     *      path="/dashboard/users",
     *      operationId="getDashUsersList",
     *      tags={"Dashboard Users"},
     *      summary="Get users list",
     *      description="Return users list",
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardUsersPagination")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function list(ListRequest $request, UserService $userService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');
        $filters = (array) $request->get('filters', []);

        $users = $userService->list($filters, $perPage, $sort);

        return UserResource::collection($users);
    }

    /**
     * @OA\Get(
     *      path="/users/{id}",
     *      operationId="getDashUser",
     *      tags={"Dashboard Users"},
     *      summary="Get user by id",
     *      description="Get user by id",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function getUser(int $userId, UserService $userService)
    {
        $user = $userService->getById($userId);

        return new UserResource($user);
    }
}
