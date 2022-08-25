<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User login request",
 *      description="User login request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class UserLoginRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email",
     *      example="example@mail.ru"
     * )
     *
     * @var string
     */
    public $email;

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
