<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ChangePasswordRequest;
use App\Http\Requests\V1\UserQuestionRequest;
use App\Http\Requests\V1\UserUpdateRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\V1\QRCodeGenerateService;
use App\Services\V1\UserQuestionService;
use App\Services\V1\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
