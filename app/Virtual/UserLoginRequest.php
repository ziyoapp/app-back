<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User login request",
 *      description="User login request body data",
 *      type="object",
 *      required={"phone", "password"}
 * )
 */
class UserLoginRequest
{
    /**
     * @OA\Property(
     *      title="Phone number",
     *      description="Phone number",
     *      example="998939887070"
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password",
     *      example="123456"
     * )
     *
     * @var string
     */
    public $password;
}
