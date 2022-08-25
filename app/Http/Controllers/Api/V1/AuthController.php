<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserLoginRequest;
use App\Models\User;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;

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
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->authService->auth(
            $request->get('email'),
            $request->get('password')
        );

        return response()->json(
            $this->respondWithToken($token)
        );
    }

    public function register(Request $request)
    {
        $validate = [
            'name' => 'required',
            'phone' => 'required|regex:/^(998)[0-9]{9}$/'
        ];

        $request->validate($validate);

        if (User::where('phone', $request->phone)->exists()) {
            return response()->json([
                'data' => [
                    'error' => 'Такой номер телефона уже существует'
                ]
            ], 400);
        }

        $userData = [
            'first_name' => $request->first_name,
            'phone' => $request->phone,
            'password' => bcrypt($request->get('password')),
            'role_id' => UserRole::USER,
            'gender' => null,
        ];

        $user = User::create($userData);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
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
