<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardEventsCollection",
 *     description="Dashboard events collection",
 *     @OA\Xml(
 *         name="DashboardEventsCollection"
 *     )
 * )
 */
class DashboardEventsCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardEvents[]
     */
    private $data;

    /**
     * @OA\Property(
     *     title="Pagination structure",
     *     description="Pagination structure"
     * )
     *
     * @var \App\Virtual\Resources\Pagination
     */
    private $meta;
}
