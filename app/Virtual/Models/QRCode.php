<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User token",
 *     description="User token",
 *     @OA\Xml(
 *         name="User token"
 *     )
 * )
 */
class QRCode
{
    /**
     * @OA\Property(
     *      title="QR code",
     *      description="QR code",
     *      example="http://bonus-app.test/storage/qrcodes/user_ball_add_5.svg"
     * )
     *
     * @var string
     */
    public $qr_code;
}
