<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="DashboardNews",
 *     description="NDashboardNews model",
 *     @OA\Xml(
 *         name="DashboardNews"
 *     )
 * )
 */
class DashboardNews
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
     *      title="Title",
     *      description="News title",
     *      example="A nice news"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the new project",
     *      example="This is new project's description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Content",
     *      description="Content of the new project",
     *      example="This is new project's Content"
     * )
     *
     * @var string
     */
    public $content;

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
     *      title="Image object",
     *      description="Image object"
     * )
     *
     * @var Picture
     */
    public $picture;

    /**
     * @OA\Property(
     *     title="Published at",
     *     description="Published at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $published_at;
}
