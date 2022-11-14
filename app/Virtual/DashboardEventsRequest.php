<?php

namespace App\Virtual;

use App\Virtual\Models\Picture;

/**
 * @OA\Schema(
 *      title="Dashboard events request",
 *      description="Events request body data",
 *      type="object",
 *      required={"title", "description", "content", "address", "ball", "register_count", "date_start", "schedule_text", "image"}
 * )
 */
class DashboardEventsRequest
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
     *      description="Event title",
     *      example="A nice event"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the event project",
     *      example="This is event project's description"
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
     *      title="Address"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      title="Ball for event"
     * )
     *
     * @var int
     */
    public $ball;

    /**
     * @OA\Property(
     *      title="Price for event"
     * )
     *
     * @var int
     */
    public $price_ball;

    /**
     * @OA\Property(
     *      title="Register users limit"
     * )
     *
     * @var int
     */
    public $register_count;

    /**
     * @OA\Property(
     *      title="Schedule text"
     * )
     *
     * @var string
     */
    public $schedule_text;

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
     *     example="2020-01-30 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $date_end;

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
