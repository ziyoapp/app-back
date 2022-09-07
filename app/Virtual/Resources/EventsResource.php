<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="EventsResource",
 *     description="Events resource",
 *     @OA\Xml(
 *         name="EventsResource"
 *     )
 * )
 */
class EventsResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Events
     */
    private $data;
}
