<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\VerifyType;
use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ChangePasswordRequest;
use App\Http\Requests\V1\PasswordResetRequest;
use App\Http\Requests\V1\PhoneNumberRequest;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Requests\V1\UserQuestionRequest;
use App\Http\Requests\V1\UserUpdateRequest;
use App\Http\Resources\V1\NotificationResource;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Models\VerifyCode;
use App\Services\V1\AuthService;
use App\Services\V1\QRCodeGenerateService;
use App\Services\V1\UserQuestionService;
use App\Services\V1\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/user",
     *      operationId="getUser",
     *      tags={"User"},
     *      summary="Get user by token",
     *      description="Get user by token",
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
    public function getUser()
    {
        $user = User::where('id', auth()->id())->first();

        return new UserResource($user);
    }

    /**
     * @OA\Post(
     *      path="/user/change-password",
     *      operationId="changePassword",
     *      tags={"User"},
     *      summary="User change password",
     *      description="User change password",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ChangePasswordRequest")
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
     * @param ChangePasswordRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function changePassword(ChangePasswordRequest $request, UserService $userService)
    {
        $userService->changePassword(
            auth()->id(),
            $request->get('current_password'),
            $request->get('new_password')
        );

        return response()->json([
            'message' => __('Пароль был успешно изменен')
        ]);
    }

    /**
     * @OA\Post(
     *      path="/user/reset-verify-code",
     *      operationId="getResetVerifyCode",
     *      tags={"User"},
     *      summary="User password reset verify code",
     *      description="User password reset verify code",
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
     * @param PhoneNumberRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function passwordResetVerifyCode(PhoneNumberRequest $request, AuthService $authService)
    {
        $code = $authService->sendVerifyCode($request->get('phone'), VerifyType::RESET_PASSWORD);

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
     *      path="/user/password-reset",
     *      operationId="userPassRecovery",
     *      tags={"User"},
     *      summary="User password reset",
     *      description="User password reset",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PasswordResetRequest")
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequest")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     *
     * @param PasswordResetRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function passwordReset(PasswordResetRequest $request, UserService $userService)
    {
        $data = $request->validated();

        /**
         * @var VerifyCode $verifyCode
         */
        $verifyCode = VerifyCode::where('phone', $data['phone'])
            ->whereType(VerifyType::RESET_PASSWORD)
            ->first();

        if (empty($verifyCode) || $verifyCode->checkCode($data['code']) === false) {
            throw new BadRequestException(__('bad_request.dont_correct_code'));
        }

        $userService->resetPassword($data['phone'], $data['password']);

        $verifyCode->delete();

        return response()->json([
            'message' => __('Пароль был успешно сброшен')
        ]);
    }

    /**
     * @OA\Get(
     *      path="/user/qr-code",
     *      operationId="getQRCode",
     *      tags={"User"},
     *      summary="Get user qr code",
     *      description="Get user qr code",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/QRCode")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function getQRCode()
    {
        $qrCode = new QRCodeGenerateService();
        $src = $qrCode->getOrGenerateUserQRCodeSrc(auth()->id());

        return response()->json([
            'qr_code' => $src
        ]);
    }

    /**
     * @OA\Post(
     *      path="/user/update",
     *      operationId="userUpdate",
     *      tags={"User"},
     *      summary="User update",
     *      description="User update",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/UserUpdateRequest")
     *         )
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
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     *
     * @param UserUpdateRequest $request
     * @param UserService $userService
     * @return UserResource
     */
    public function userUpdate(UserUpdateRequest $request, UserService $userService)
    {
        $validatedData = $request->validated();
        $user = $userService->update(auth()->id(), $validatedData);

        return new UserResource($user);
    }

    /**
     * @OA\Post(
     *      path="/user/question",
     *      operationId="userQuestion",
     *      tags={"User"},
     *      summary="User question",
     *      description="User question",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserQuestionRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     *
     * @param UserQuestionRequest $request
     * @param UserQuestionService $userQuestionService
     * @return \Illuminate\Http\Response
     */
    public function userQuestion(UserQuestionRequest $request, UserQuestionService $userQuestionService)
    {
        $validatedData = $request->validated();

        if (!empty(auth()->id())) {
            $validatedData['user_id'] = auth()->id();
        }

        $userQuestionService->store($validatedData);

        return response()->noContent(200);
    }

    /**
     * @OA\Get(
     *      path="/user/notifications",
     *      operationId="getUserNotifications",
     *      tags={"User notifications"},
     *      summary="Get list of notifications",
     *      description="Returns list of notifications",
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
     *          @OA\JsonContent(ref="#/components/schemas/NotificationPagination")
     *       )
     * )
     */
    public function notifications(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);

        return NotificationResource::collection(auth()->user()->notifications()->paginate($perPage));
    }

    /**
     * @OA\Post(
     *      path="/user/notifications/read-all",
     *      operationId="notifyReadAll",
     *      tags={"User notifications"},
     *      summary="Mark as read all notifications",
     *      description="Mark as read all notifications",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     *
     * @return JsonResponse
     */
    public function readAllNotifications()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);

        return response()->json();
    }

    /**
     * @OA\Post(
     *      path="/user/notifications/{uuid}/read",
     *      operationId="notifyRead",
     *      tags={"User notifications"},
     *      summary="Mark as read notification by id",
     *      description="Mark as read notification by id",
     *     @OA\Parameter(
     *          name="uuid",
     *          description="Notification id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     *
     * @return JsonResponse
     */
    public function readNotification($uuid)
    {
        auth()->user()->unreadNotifications()->where('id', $uuid)->update(['read_at' => now()]);

        return response()->json([
            'id' => $uuid
        ]);
    }

    /**
     * @OA\Patch(
     *      path="/user/push-token",
     *      operationId="userPushToken",
     *      tags={"User"},
     *      summary="User push token save",
     *      description="User push token save",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PushTokenSaveRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\BadRequestException
     */
    public function updatePushToken(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string']
        ]);

        try {
            $request->user()->update(['fcm_token' => $request->token]);

            return response()->json();
        } catch (\Exception $e) {
            report($e);

            return response()->json([], 500);
        }
    }
}
