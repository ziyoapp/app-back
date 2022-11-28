<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Category request",
 *      description="Category request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class CategoryRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Category name"
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
