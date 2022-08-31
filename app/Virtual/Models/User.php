<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

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
     *      example="Smith"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *      title="Patronymic",
     *      description="Patronymic",
     *      example="David"
     * )
     *
     * @var string
     */
    public $patronymic;

    /**
     * @OA\Property(
     *      title="Phone",
     *      description="Phone",
     *      example="998939604040"
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *      title="Gender",
     *      description="Gender",
     *      example="male"
     * )
     *
     * @var string
     */
    public $gender;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email",
     *      example="example@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Email verify",
     *      description="Email verify",
     *      example="true"
     * )
     *
     * @var bool
     */
    public $email_verified;

    /**
     * @OA\Property(
     *      title="User role",
     *      description="User role",
     *      example="user"
     * )
     *
     * @var \App\Virtual\Models\UserRole
     */
    public $role;
}
