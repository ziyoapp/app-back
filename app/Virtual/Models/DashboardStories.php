<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="DashboardStories",
 *     description="DashboardStories model",
 *     @OA\Xml(
 *         name="DashboardStories"
 *     )
 * )
 */
class DashboardStories
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
     *      description="Story name"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Image object",
     *      description="Image object"
     * )
     *
     * @var Picture
     */
    public $preview_img;

    /**
     * @OA\Property(
     *      title="Image objects",
     *      description="Image objects"
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
