<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="ProductsList",
 *     description="Products list model",
 *     @OA\Xml(
 *         name="ProductsList"
 *     )
 * )
 */
class ProductsList
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
     *      title="Image path",
     *      description="Image path",
     *      example="https://ziyoforum-app.uz/storage/19/360x160.png"
     * )
     *
     * @var string
     */
    public $image_url;

}
