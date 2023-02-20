<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Exceptions\BadRequestException;
use App\Http\Requests\UserLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController
{
    /**
     * @OA\Post(
     *      path="/dashboard/login",
     *      operationId="dashboardLogin",
     *      tags={"Dashboard"},
     *      summary="Dashboard user login",
     *      description="Dashboard user login",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserLoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserToken")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequest")
     *      )
     * )
     *
     * @param UserLoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function dashboardLogin(UserLoginRequest $request, AuthService $authService)
    {
        $token = $authService->dashboardLogin(
            $request->get('email'),
            $request->get('password')
        );

        return response()->json([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL()
        ]);
    }
}
