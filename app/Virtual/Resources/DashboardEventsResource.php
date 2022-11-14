<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardEventsResource",
 *     description="Dashboard events resource",
 *     @OA\Xml(
 *         name="DashboardEventsResource"
 *     )
 * )
 */
class DashboardEventsResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardEvents
     */
    private $data;
}
