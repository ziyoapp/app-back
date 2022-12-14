<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ProductsCollection",
 *     description="Products collection",
 *     @OA\Xml(
 *         name="ProductsCollection"
 *     )
 * )
 */
class ProductsCollection
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
}
