<?php

namespace App\Virtual\Models;


/**
 * @OA\Schema(
 *     title="Events",
 *     description="Events model",
 *     @OA\Xml(
 *         name="Events"
 *     )
 * )
 */
class Events
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
     *     title="Labels",
     *     description="Labels",
     * )
     *
     * @var Labels[]
     */
    public $labels;

    /**
     * @OA\Property(
     *      title="Event type",
     *      description="Type event",
     *      example="exclusive"
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *      title="User subscribe",
     *      description="User subscribe",
     *      example="true"
     * )
     *
     * @var bool
     */
    public $subscribed;

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
     *     title="Date start at",
     *     description="Date start at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $date_start;

    /**
     * @OA\Property(
     *     title="Date end at",
     *     description="Date end at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $date_end;

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
