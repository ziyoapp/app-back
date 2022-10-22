<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ProductCategoryCollection",
 *     description="Category collection",
 *     @OA\Xml(
 *         name="ProductCategoryCollection"
 *     )
 * )
 */
class ProductCategoryCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\ProductCategory[]
     */
    private $data;
}
