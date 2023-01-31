<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Dashboard stories request",
 *      description="Story request body data",
 *      type="object",
 *      required={"title", "preview_image", "status"}
 * )
 */
class DashboardStoriesRequest
{
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
     *      title="Upload picture",
     *     format="binary"
     * )
     *
     * @var string
     */
    public $preview_image;

    /**
     * @OA\Property(
     *      title="Screen images",
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
