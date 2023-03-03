<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Product order model",
 *     description="Product order model",
 *     @OA\Xml(
 *         name="ProductOrderModel"
 *     )
 * )
 */
class ProductOrderModel
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
     *     title="User data",
     *     description="User data",
     * )
     *
     * @var ProductOrderUser
     */
    public $user;

    /**
     * @OA\Property(
     *     title="Product data",
     *     description="Product data",
     * )
     *
     * @var ProductOrderProduct
     */
    public $product;

    /**
     * @OA\Property(
     *     title="Total score for order",
     *     description="Total score for order"
     * )
     *
     * @var integer
     */
    public $total_score;

    /**
     * @OA\Property(
     *      title="Order status",
     *      description="Order status",
     *     example="new|completed|canceled"
     * )
     *
     * @var string
     */
    public $order_status;
}
