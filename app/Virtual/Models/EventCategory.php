<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="EventCategory",
 *     description="EventCategory",
 *     @OA\Xml(
 *         name="EventCategory"
 *     )
 * )
 */
class EventCategory
{
    /**
     * @OA\Property(
     *      title="Id category",
     *      description="ID"
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Category name",
     *      description="Category name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Events total count in category",
     *      description="Events total count in category"
     * )
     *
     * @var int
     */
    public $events_count;
}
