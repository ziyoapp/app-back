<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\VerifyType;
use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Requests\V1\UserLoginRequest;
use App\Models\User;
use App\Models\VerifyCode;
use App\Services\V1\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
     *      path="/user/register-verify-code",
     *      operationId="getVerifyRegisterCode",
     *      tags={"User"},
     *      summary="User register verify code",
     *      description="User register verify code",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VerifyCodeRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequest")
     *      )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function registerVerifyCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^(998)[0-9]{9}$/'
        ]);

        $code = $this->authService->sendVerifyCode($request->get('phone'), VerifyType::REGISTER);

        $data = [];
        if (App::environment(['local', 'staging'])) {
            $data = [
                'code' => $code
            ];
        }

        return response()->json($data);
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->authService->auth(
            $request->get('phone'),
            $request->get('password')
        );

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
     *          response=200,
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
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function register(RegisterRequest $request)
    {
        $registerData = $request->validated();

        /**
         * @var VerifyCode $verifyCode
         */
        $verifyCode = VerifyCode::where('phone', $registerData['phone'])
            ->whereType(VerifyType::REGISTER)
            ->first();

        if (empty($verifyCode) || $verifyCode->checkCode($registerData['code']) === false) {
            throw new BadRequestException(__('bad_request.dont_correct_code'));
        }

        $user = $this->authService->register(array_merge($registerData, [
            'user_lang' => $request->header('x-lang-code', 'ru')
        ]));

        //event(new Registered($user));

        $token = auth()->login($user);

        $verifyCode->delete();

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
