<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Products model",
 *     @OA\Xml(
 *         name="Product"
 *     )
 * )
 */
class Product
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
     *      title="Product name",
     *      description="Product name",
     *      example="Product #1"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Product description",
     *      description="Product description",
     *      example="Product description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="Price",
     *     description="Price",
     * )
     *
     * @var float
     */
    public $price;

    /**
     * @OA\Property(
     *     title="Price old",
     *     description="Price old",
     * )
     *
     * @var float
     */
    public $price_old;

    /**
     * @OA\Property(
     *     title="Product quantity",
     *     description="Product quantity",
     *     example=100
     * )
     *
     * @var integer
     */
    public $quantity;

    /**
     * @OA\Property(
     *     title="Categories",
     *     description="Categories",
     * )
     *
     * @var ProductCategoryForProduct[]
     */
    public $categories;

    /**
     * @OA\Property(
     *      title="Image paths collection",
     *      description="Image paths collection",
     * )
     *
     * @var string[]
     */
    public $images;

}
