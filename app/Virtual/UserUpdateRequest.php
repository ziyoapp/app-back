<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User update request",
 *      description="User update request body data",
 *      type="object",
 *      required={"first_name", "last_name", "birth_date", "gender", "phone"}
 * )
 */
class UserUpdateRequest
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
}
