<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Dashboard news request",
 *      description="News request body data",
 *      type="object",
 *      required={"title", "description", "image"}
 * )
 */
class DashboardNewsRequest
{
    /**
     * @OA\Property(
     *      title="Заголовок"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Content"
     * )
     *
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *      title="Upload picture",
     *     format="binary"
     * )
     *
     * @var string
     */
    public $image;

    /**
     * @OA\Property(
     *      title="Publish status",
     *     example="draft"
     * )
     *
     * @var string
     */
    public $status;

    /**
     * @OA\Property(
     *      title="Published date",
     *     example="2022-10-10 16:10:00"
     * )
     *
     * @var string
     */
    public $published_date;
}
