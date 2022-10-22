<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ProductsPagination",
 *     description="Products pagination",
 *     @OA\Xml(
 *         name="ProductsPagination"
 *     )
 * )
 */
class ProductsPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\ProductsList[]
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
