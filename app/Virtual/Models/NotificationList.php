<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="NotificationList",
 *     description="Notification list model",
 *     @OA\Xml(
 *         name="NotificationList"
 *     )
 * )
 */
class NotificationList
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="uuid4"
     * )
     *
     * @var string
     */
    public $id;


    /**
     * @OA\Property(
     *      title="Notification type",
     *      description="Notification event"
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *     title="Data fields",
     *     description="Data fields",
     * )
     *
     * @var NotifyFields[]
     */
    public $data;

    /**
     * @OA\Property(
     *      title="Mark as read",
     *      description="Mark as read"
     * )
     *
     * @var bool
     */
    public $is_read;

    /**
     * @OA\Property(
     *     title="Date at",
     *     description="Published at",
     *     example="10.01.2023 17:50",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $date;
}
