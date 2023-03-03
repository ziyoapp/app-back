<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="ProductOrderUser",
 *     description="ProductOrderUser",
 *     @OA\Xml(
 *         name="ProductOrderUser"
 *     )
 * )
 */
class ProductOrderUser
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
}
