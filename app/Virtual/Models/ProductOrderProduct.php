<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="ProductOrderProduct",
 *     description="ProductOrderProduct",
 *     @OA\Xml(
 *         name="ProductOrderProduct"
 *     )
 * )
 */
class ProductOrderProduct
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
     *      description="Product name"
     * )
     *
     * @var string
     */
    public $name;
}
