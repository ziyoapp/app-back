<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Push token save request",
 *      description="Push token save body data",
 *      type="object",
 *      required={"token"}
 * )
 */
class PushTokenSaveRequest
{
    /**
     * @OA\Property(
     *      title="Push token",
     *      description="Push token"
     * )
     *
     * @var string
     */
    public $token;
}
