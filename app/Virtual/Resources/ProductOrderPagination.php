<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ProductOrderPagination",
 *     description="ProductOrderPagination",
 *     @OA\Xml(
 *         name="ProductOrderPagination"
 *     )
 * )
 */
class ProductOrderPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\ProductOrderModel[]
     */
    private $data;

    /**
     * @OA\Property(
     *     title="Pagination structure",
     *     description="Pagination structure"
     * )
     *
     * @var \App\Virtual\Resources\Pagination
     */
    private $meta;
}
