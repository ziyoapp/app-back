<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Product order status",
 *      description="Product order status",
 *      type="object",
 *      required={"order_id", "status"}
 * )
 */
class ProductOrderStatusRequest
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
    public $order_id;

    /**
     * @OA\Property(
     *      title="Статус заказа",
     *      example="completed|canceled"
     * )
     *
     * @var string
     */
    public $status;
}
