<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Requests\V1\UserLoginRequest;
use App\Models\User;
use App\Services\V1\AuthService;
use App\Services\V1\QRCodeGenerateService;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * @OA\Post(
     *      path="/user/login",
     *      operationId="userLogin",
     *      tags={"User"},
     *      summary="User login",
     *      description="User login",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserLoginRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->authService->auth(
            $request->get('email'),
            $request->get('password')
        );

        $qrCode = new QRCodeGenerateService();
        $qrCode->generateForUser(auth()->id());

        return response()->json(
            $this->respondWithToken($token)
        );
    }

    /**
     * @OA\Post(
     *      path="/user/register",
     *      operationId="userRegister",
     *      tags={"User"},
     *      summary="User register",
     *      description="User register",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserToken")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $registerData = $request->validated();

        $user = $this->authService->register(array_merge($registerData, [
            'user_lang' => $request->header('x-lang-code', 'ru')
        ]));

        //event(new Registered($user));

        $token = auth()->login($user);

        return response()->json(
            $this->respondWithToken($token)
        );
    }

    /**
     * @OA\Post(
     *      path="/user/logout",
     *      operationId="userLogout",
     *      tags={"User"},
     *      summary="User logout",
     *      description="User logout",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function logout()
    {
        $this->authService->logout();

        return response()->json();
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return [
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL()
        ];
    }
}
