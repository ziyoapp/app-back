<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardNewsResource",
 *     description="Dashboard news resource",
 *     @OA\Xml(
 *         name="DashboardNewsResource"
 *     )
 * )
 */
class DashboardNewsResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardNews
     */
    private $data;
}
