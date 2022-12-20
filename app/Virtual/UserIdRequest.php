<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User Id request",
 *      description="User ID request body data",
 *      type="object",
 *      required={"user_id"}
 * )
 */
class UserIdRequest
{
    /**
     * @OA\Property(
     *      title="User id"
     * )
     *
     * @var int
     */
    public $user_id;
}
