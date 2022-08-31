<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\V1\QRCodeGenerateService;
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
}
