<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="DashboardCategory",
 *     description="DashboardCategory model",
 *     @OA\Xml(
 *         name="DashboardCategory"
 *     )
 * )
 */
class DashboardCategory
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

    /**
     * @OA\Property(
     *      title="Sorting",
     *      description="Sort category"
     * )
     *
     * @var int
     */
    public $sort;
}
