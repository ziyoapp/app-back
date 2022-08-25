<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="News",
 *     description="News model",
 *     @OA\Xml(
 *         name="News"
 *     )
 * )
 */
class News
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
     *      title="Image path",
     *      description="Image path",
     *      example="https://ziyoforum-app.uz/storage/19/360x160.png"
     * )
     *
     * @var string
     */
    public $image_url;

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
