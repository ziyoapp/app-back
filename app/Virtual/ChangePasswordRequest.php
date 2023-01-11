<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User change passwod request",
 *      description="User change passwod request body data",
 *      type="object",
 *      required={"current_password", "new_password", "new_password_confirmation"}
 * )
 */
class ChangePasswordRequest
{
    /**
     * @OA\Property(
     *      title="Current password",
     *      description="Current password"
     * )
     *
     * @var string
     */
    public $current_password;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password",
     *      example="12345678"
     * )
     *
     * @var string
     */
    public $new_password;

    /**
     * @OA\Property(
     *      title="Password confirm",
     *      description="Password confirm",
     *      example="12345678"
     * )
     *
     * @var string
     */
    public $new_password_confirmation;
}
