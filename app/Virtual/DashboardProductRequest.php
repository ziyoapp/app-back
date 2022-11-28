<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Dashboard product request",
 *      description="Product request body data",
 *      type="object",
 *      required={"name", "description", "price", "quantity", "images", "category_id", "status"}
 * )
 */
class DashboardProductRequest
{
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
     *      title="Product price",
     *     description="Product Price"
     * )
     *
     * @var int
     */
    public $price;

    /**
     * @OA\Property(
     *      title="Product old price",
     *     description="Product old price"
     * )
     *
     * @var int
     */
    public $price_old;

    /**
     * @OA\Property(
     *      title="Product quantity",
     *     description="Product quantity"
     * )
     *
     * @var int
     */
    public $quantity;

    /**
     * @OA\Property(
     *      title="Product category id",
     *     description="Product category id"
     * )
     *
     * @var int
     */
    public $category_id;

    /**
     * @OA\Property(
     *      title="Images array",
     *      description="Images array",
     *     format="binary",
     *     @OA\Items()
     * ),
     *
     *
     * @var array
     */
    public $images;

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
     *      title="Sort product",
     *     description="Sort product",
     * )
     *
     * @var int
     */
    public $sort;
}
