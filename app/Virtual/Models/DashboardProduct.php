<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="DashboardProduct",
 *     description="DashboardProduct model",
 *     @OA\Xml(
 *         name="DashboardProduct"
 *     )
 * )
 */
class DashboardProduct
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
     *      title="Name",
     *      description="Product name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Product description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Product price"
     * )
     *
     * @var int
     */
    public $price;

    /**
     * @OA\Property(
     *      title="Product old price"
     * )
     *
     * @var int
     */
    public $price_old;

    /**
     * @OA\Property(
     *      title="Product quantity"
     * )
     *
     * @var int
     */
    public $quantity;

    /**
     * @OA\Property(
     *      title="Product category id"
     * )
     *
     * @var int
     */
    public $category_id;

    /**
     * @OA\Property(
     *      title="Image object",
     *      description="Image object"
     * )
     *
     * @var Picture[]
     */
    public $pictures;

    /**
     * @OA\Property(
     *      title="Publish status",
     *      description="Publish status",
     *      example="publish"
     * )
     *
     * @var string
     */
    public $status;

    /**
     * @OA\Property(
     *      title="Sort product"
     * )
     *
     * @var int
     */
    public $sort;
}
