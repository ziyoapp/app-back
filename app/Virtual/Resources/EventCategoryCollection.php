<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="EventCategoryCollection",
 *     description="Category collection",
 *     @OA\Xml(
 *         name="EventCategoryCollection"
 *     )
 * )
 */
class EventCategoryCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\EventCategory[]
     */
    private $data;
}
