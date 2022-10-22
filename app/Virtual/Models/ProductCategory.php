<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="ProductCategory",
 *     description="ProductCategory",
 *     @OA\Xml(
 *         name="ProductCategory"
 *     )
 * )
 */
class ProductCategory
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

    /**
     * @OA\Property(
     *      title="Products total count in category",
     *      description="Products total count in category"
     * )
     *
     * @var int
     */
    public $products_count;
}
