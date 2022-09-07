<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="EventsCollection",
 *     description="Events collection",
 *     @OA\Xml(
 *         name="EventsCollection"
 *     )
 * )
 */
class EventsCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\EventsList[]
     */
    private $data;
}
