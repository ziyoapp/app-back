<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="ProductCategoryForProduct",
 *     description="ProductCategoryForProduct",
 *     @OA\Xml(
 *         name="ProductCategoryForProduct"
 *     )
 * )
 */
class ProductCategoryForProduct
{
    /**
     * @OA\Property(
     *      title="Id model",
     *      description="ID"
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Category name",
     *      description="Category name",
     *      example="Ziyo Forum"
     * )
     *
     * @var string
     */
    public $name;
}
