<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ProductOrderResource",
 *     description="ProductOrderResource resource",
 *     @OA\Xml(
 *         name="ProductOrderResource"
 *     )
 * )
 */
class ProductOrderResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\ProductOrderModel
     */
    private $data;
}
