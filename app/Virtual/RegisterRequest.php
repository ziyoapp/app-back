<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User register request",
 *      description="User register request body data",
 *      type="object",
 *      required={"first_name", "last_name", "birth_date", "gender", "phone", "email", "password", "password_confirm", "privacy_accept"}
 * )
 */
class RegisterRequest
{
    /**
     * @OA\Property(
     *      title="First name",
     *      description="First name",
     *      example="John"
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *      title="Last name",
     *      description="Last name",
     *      example="Wick"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *      title="Birth date",
     *      description="Birth date",
     *      example="20-05-1995"
     * )
     *
     * @var string
     */
    public $birth_date;

    /**
     * @OA\Property(
     *      title="Gender",
     *      description="Gender",
     *      example="male|female"
     * )
     *
     * @var string
     */
    public $gender;

    /**
     * @OA\Property(
     *      title="Phone number",
     *      description="Phone number",
     *      example="+998939887070"
     * )
     *
     * @var string
     */
    public $phone;

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
    public $password_confirm;

    /**
     * @OA\Property(
     *      title="Privacy accept",
     *      description="Privacy accept",
     *      example="true"
     * )
     *
     * @var bool
     */
    public $password_confirmation;
}
