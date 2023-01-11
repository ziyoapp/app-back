<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User register request",
 *      description="User register request body data",
 *      type="object",
 *      required={"phone", "password", "password_confirm", "code"}
 * )
 */
class RegisterRequest
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
     *      example="12345678"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="Password confirm",
     *      description="Password confirm",
     *      example="12345678"
     * )
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * @OA\Property(
     *      title="Verify code",
     *      description="Verify code",
     *      example="4040"
     * )
     *
     * @var int
     */
    public $code;
}
